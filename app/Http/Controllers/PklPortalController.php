<?php

namespace App\Http\Controllers;

use App\Models\IndustryPartner;
use App\Models\PklApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PklPortalController extends Controller
{
    /**
     * Menampilkan katalog mitra industri DUDI dan pencarian lowongan PKL
     */
    public function index(Request $request): View
    {
        $query = IndustryPartner::query()->where('is_verified', true);

        // Filter kata kunci pencarian
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('industry_sector', 'like', "%{$search}%")
                  ->orWhere('job_description', 'like', "%{$search}%")
                  ->orWhere('requirements', 'like', "%{$search}%");
            });
        }

        // Filter jurusan vokasi
        if ($major = $request->input('major')) {
            if ($major !== 'Semua') {
                $query->where('vocational_majors', 'like', "%{$major}%");
            }
        }

        // Filter kota/wilayah
        if ($city = $request->input('city')) {
            if ($city !== 'Semua') {
                $query->where('city', 'like', "%{$city}%");
            }
        }

        // Filter ketersediaan kuota
        if ($request->input('quota') === 'available') {
            $query->whereRaw('total_quota > filled_quota');
        }

        // Sort option
        $sort = $request->input('sort', 'default');
        if ($sort === 'quota_desc') {
            $query->orderByRaw('(total_quota - filled_quota) DESC');
        } elseif ($sort === 'name_asc') {
            $query->orderBy('company_name', 'ASC');
        } else {
            $query->orderByDesc('id');
        }

        $partners = $query->get();

        // Ringkasan statistik riil
        $allPartners = IndustryPartner::all();
        $stats = [
            'total_partners' => $allPartners->count(),
            'total_quota' => $allPartners->sum('total_quota'),
            'available_quota' => $allPartners->sum('available_quota'),
            'total_applications' => PklApplication::count(),
            'acceptance_rate' => PklApplication::count() > 0 
                ? round((PklApplication::where('status', 'accepted')->count() / PklApplication::count()) * 100) 
                : 85,
        ];

        $popularMajors = ['RPL', 'TKJ', 'DKV', 'TKRO', 'AKL', 'DPIB'];
        
        // Hitung ketersediaan per jurusan
        $majorCounts = [];
        foreach ($popularMajors as $m) {
            $majorCounts[$m] = IndustryPartner::where('vocational_majors', 'like', "%{$m}%")->count();
        }

        // Daftar kota unik dari database
        $cities = IndustryPartner::select('city')->distinct()->pluck('city')->map(function($c) {
            return explode(',', $c)[0];
        })->unique()->values();

        return view('pkl.index', compact('partners', 'stats', 'popularMajors', 'majorCounts', 'cities'));
    }

    /**
     * Mengambil detail mitra industri (JSON untuk modal interaktif & form)
     */
    public function apiPartnerDetail(int $id): JsonResponse
    {
        $partner = IndustryPartner::findOrFail($id);

        return response()->json([
            'id' => $partner->id,
            'company_name' => $partner->company_name,
            'industry_sector' => $partner->industry_sector,
            'city' => $partner->city,
            'address' => $partner->address,
            'vocational_majors' => $partner->majors_list,
            'total_quota' => $partner->total_quota,
            'filled_quota' => $partner->filled_quota,
            'available_quota' => $partner->available_quota,
            'allowance' => $partner->allowance,
            'duration' => $partner->duration,
            'requirements' => $partner->requirements,
            'job_description' => $partner->job_description,
            'mentor_name' => $partner->mentor_name,
            'contact_email' => $partner->contact_email,
        ]);
    }

    /**
     * Memproses pengajuan pendaftaran PKL siswa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'industry_partner_id' => 'required|exists:industry_partners,id',
            'student_name' => 'required|string|min:3|max:100',
            'nisn' => 'required|numeric|digits:10',
            'school_name' => 'required|string|min:3|max:100',
            'major' => 'required|string|max:80',
            'whatsapp_number' => 'required|string|min:9|max:18',
            'guardian_teacher_name' => 'nullable|string|max:100',
            'internship_period' => 'required|string|max:60',
            'portfolio_url' => 'nullable|url|max:255',
            'notes' => 'nullable|string|max:500',
        ], [
            'student_name.required' => 'Nama lengkap siswa wajib diisi.',
            'nisn.required' => 'Nomor Induk Siswa Nasional (NISN) wajib diisi.',
            'nisn.digits' => 'NISN harus tepat berjumlah 10 digit angka.',
            'school_name.required' => 'Nama asal sekolah SMK wajib diisi.',
            'major.required' => 'Kompetensi keahlian/jurusan wajib dipilih.',
            'whatsapp_number.required' => 'Nomor WhatsApp siswa wajib diisi untuk konfirmasi.',
            'portfolio_url.url' => 'Format tautan portofolio harus berupa URL yang valid (misal: https://...).',
        ]);

        $partner = IndustryPartner::findOrFail($validated['industry_partner_id']);

        if ($partner->available_quota <= 0) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, kuota penerimaan magang pada mitra industri ini telah penuh.',
                ], 422);
            }

            return back()->withInput()->withErrors(['quota' => 'Kuota mitra industri ini telah penuh.']);
        }

        // Cek duplikasi pengajuan dengan NISN dan mitra yang sama
        $existing = PklApplication::where('industry_partner_id', $partner->id)
            ->where('nisn', $validated['nisn'])
            ->first();

        if ($existing) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => "Anda telah mengajukan pendaftaran ke mitra ini sebelumnya dengan nomor tiket {$existing->ticket_number}.",
                ], 422);
            }

            return back()->withInput()->withErrors(['nisn' => "NISN ini sudah terdaftar pada mitra ini (Tiket: {$existing->ticket_number})."]);
        }

        // Generate nomor tiket unik terstruktur
        $ticketNumber = 'PKL-' . date('Y') . '-' . str_pad((string) (PklApplication::count() + 1), 4, '0', STR_PAD_LEFT);

        $application = PklApplication::create([
            'ticket_number' => $ticketNumber,
            'industry_partner_id' => $partner->id,
            'student_name' => $validated['student_name'],
            'nisn' => $validated['nisn'],
            'school_name' => $validated['school_name'],
            'major' => $validated['major'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'guardian_teacher_name' => $validated['guardian_teacher_name'] ?? null,
            'internship_period' => $validated['internship_period'],
            'portfolio_url' => $validated['portfolio_url'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'review_school',
        ]);

        // Tambah kuota terisi
        $partner->increment('filled_quota');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan PKL berhasil dikirim!',
                'ticket_number' => $application->ticket_number,
                'student_name' => $application->student_name,
                'company_name' => $partner->company_name,
                'status' => $application->status_label,
            ]);
        }

        return redirect()->route('pkl.tracking', ['ticket' => $ticketNumber])
            ->with('success', "Pengajuan PKL berhasil didaftarkan! Simpan nomor tiket Anda: {$ticketNumber}");
    }

    /**
     * Pelacakan status pendaftaran PKL siswa
     */
    public function tracking(Request $request): View
    {
        $search = $request->input('ticket');
        $application = null;

        if ($search) {
            $application = PklApplication::with('partner')
                ->where('ticket_number', trim($search))
                ->orWhere('nisn', trim($search))
                ->first();
        }

        $recentApplications = PklApplication::with('partner')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('pkl.tracking', compact('application', 'search', 'recentApplications'));
    }

    /**
     * Simulasi payload webhook untuk otomasi n8n & Fonnte WhatsApp
     */
    public function webhookSimulation(string $ticket): JsonResponse
    {
        $application = PklApplication::with('partner')->where('ticket_number', $ticket)->firstOrFail();

        return response()->json([
            'event' => 'pkl.application_submitted',
            'timestamp' => now()->toIso8601String(),
            'payload' => [
                'ticket_number' => $application->ticket_number,
                'student' => [
                    'name' => $application->student_name,
                    'nisn' => $application->nisn,
                    'school' => $application->school_name,
                    'major' => $application->major,
                    'whatsapp' => $application->whatsapp_number,
                ],
                'industry' => [
                    'name' => $application->partner->company_name,
                    'sector' => $application->partner->industry_sector,
                    'city' => $application->partner->city,
                    'mentor' => $application->partner->mentor_name,
                ],
                'period' => $application->internship_period,
                'status' => $application->status,
                'status_label' => $application->status_label,
                'whatsapp_message_preview' => "Halo {$application->student_name}, berkas pengajuan PKL Anda untuk mitra {$application->partner->company_name} berhasil didaftarkan dengan No Tiket: {$application->ticket_number}. Silakan pantau status verifikasi sekolah Anda.",
            ],
        ]);
    }
}
