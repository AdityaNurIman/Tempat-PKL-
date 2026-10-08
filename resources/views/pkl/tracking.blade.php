@extends('layouts.app')

@section('title', 'Lacak Status Pengajuan PKL Siswa')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    <!-- Search Header -->
    <div class="text-center space-y-3 no-print">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
            Layanan Mandiri Pelacakan Siswa
        </span>
        <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            Pelacakan Status Pengajuan Tempat PKL
        </h1>
        <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto leading-relaxed">
            Masukkan Nomor Tiket Registrasi (contoh: <strong class="text-emerald-700">PKL-2026-0012</strong>) atau 10 digit NISN Anda untuk memeriksa progres verifikasi sekolah dan konfirmasi industri.
        </p>

        <!-- Search Form -->
        <form action="{{ route('pkl.tracking') }}" method="GET" class="max-w-xl mx-auto pt-2">
            <div class="flex flex-col sm:flex-row gap-2 bg-white p-2.5 rounded-2xl shadow-xs border border-slate-300 card-hover">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                    <input type="text" name="ticket" value="{{ $search }}" required placeholder="Ketik No Tiket atau NISN..." class="w-full pl-10 pr-3 py-2 text-xs sm:text-sm text-slate-900 bg-transparent rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                </div>
                <button type="submit" class="btn px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-xs focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[44px]">
                    Lacak Pengajuan
                </button>
            </div>
        </form>
    </div>

    <!-- Application Details Card -->
    @if($application)
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden space-y-6 p-6 sm:p-10 relative">
            
            <!-- Official Header for Print -->
            <div class="hidden print:block border-b-2 border-slate-900 pb-4 mb-6 text-center">
                <h2 class="text-xl font-bold uppercase tracking-wider">TANDA BUKTI PENDAFTARAN PRAKTIK KERJA LAPANGAN (PKL)</h2>
                <p class="text-xs text-slate-600">Sistem Informasi Penempatan Magang Industri SMK & DUDI Vokasi</p>
                <p class="text-[10px] text-slate-500">Tahun Ajaran 2026/2027</p>
            </div>

            <!-- Header Ticket & Status -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-6">
                <div>
                    <span class="text-xs font-bold text-slate-500 block uppercase tracking-wider">Nomor Tiket Registrasi:</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-mono">{{ $application->ticket_number }}</h2>
                    <span class="text-xs text-slate-500 mt-1 block">Tercatat di pangkalan data pada: {{ $application->created_at->format('d M Y, H:i') }} WIB</span>
                </div>

                <div>
                    <span class="inline-flex items-center text-xs font-bold px-3.5 py-2 rounded-xl border {{ $application->status_badge_class }}">
                        <span class="w-2.5 h-2.5 rounded-full mr-2 {{ $application->status === 'accepted' ? 'bg-emerald-600' : ($application->status === 'rejected' ? 'bg-rose-600' : 'bg-amber-600') }}"></span>
                        {{ $application->status_label }}
                    </span>
                </div>
            </div>

            <!-- Visual Progress Tracker (Stepper) -->
            <div class="py-2 no-print">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-4">Tahapan Alur Pengajuan:</span>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Step 1 -->
                    <div class="p-4 rounded-2xl border {{ $application ? 'border-emerald-300 bg-emerald-50/40' : 'border-slate-200 bg-slate-50' }} card-hover">
                        <div class="flex items-center space-x-2.5">
                            <span class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold shadow-2xs">1</span>
                            <span class="text-xs font-bold text-slate-900">Pendaftaran Berkas</span>
                        </div>
                        <p class="text-[11px] text-slate-600 mt-2.5 leading-relaxed">Data diri dan portofolio siswa berhasil masuk ke sistem pangkalan data.</p>
                        <span class="text-[11px] text-emerald-800 font-bold block mt-2">Selesai (Tervalidasi)</span>
                    </div>

                    <!-- Step 2 -->
                    <div class="p-4 rounded-2xl border {{ in_array($application->status, ['review_school', 'accepted']) ? 'border-emerald-300 bg-emerald-50/40' : 'border-slate-200 bg-slate-50' }} card-hover">
                        <div class="flex items-center space-x-2.5">
                            <span class="w-7 h-7 rounded-full {{ in_array($application->status, ['review_school', 'accepted']) ? 'bg-emerald-600 text-white' : 'bg-slate-300 text-slate-600' }} flex items-center justify-center text-xs font-bold shadow-2xs animate-scale-in" style="animation-delay: 0.1s;">2</span>
                            <span class="text-xs font-bold text-slate-900">Verifikasi Sekolah</span>
                        </div>
                        <p class="text-[11px] text-slate-600 mt-2.5 leading-relaxed">Pemeriksaan syarat akademik dan penerbitan Surat Tugas oleh BKK/Hubin.</p>
                        <span class="text-[11px] {{ $application->status === 'review_school' ? 'text-amber-800 font-bold' : 'text-emerald-800 font-bold' }} block mt-2">
                            {{ $application->status === 'review_school' ? 'Sedang Diverifikasi Guru' : 'Selesai Diverifikasi' }}
                        </span>
                    </div>

                    <!-- Step 3 -->
                    <div class="p-4 rounded-2xl border {{ $application->status === 'accepted' ? 'border-emerald-300 bg-emerald-50/40' : ($application->status === 'rejected' ? 'border-rose-300 bg-rose-50/40' : 'border-slate-200 bg-slate-50') }} card-hover">
                        <div class="flex items-center space-x-2.5">
                            <span class="w-7 h-7 rounded-full {{ $application->status === 'accepted' ? 'bg-emerald-600 text-white' : ($application->status === 'rejected' ? 'bg-rose-600 text-white' : 'bg-slate-300 text-slate-600') }} flex items-center justify-center text-xs font-bold shadow-2xs animate-scale-in" style="animation-delay: 0.2s;">3</span>
                            <span class="text-xs font-bold text-slate-900">Penerimaan Industri</span>
                        </div>
                        <p class="text-[11px] text-slate-600 mt-2.5 leading-relaxed">Konfirmasi kuota resmi dan penerbitan jadwal masuk oleh pembimbing DUDI.</p>
                        <span class="text-[11px] {{ $application->status === 'accepted' ? 'text-emerald-800 font-bold' : ($application->status === 'rejected' ? 'text-rose-800 font-bold' : 'text-slate-500 font-medium') }} block mt-2">
                            {{ $application->status === 'accepted' ? 'Diterima di Perusahaan' : ($application->status === 'rejected' ? 'Ditolak / Kuota Penuh' : 'Menunggu Konfirmasi') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Detailed Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <!-- Info Siswa -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-3 text-xs card-hover">
                    <h3 class="font-bold text-slate-900 border-b border-slate-200 pb-2.5 flex items-center text-sm">
                        <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Data Diri Calon Peserta PKL:
                    </h3>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Nama Lengkap:</span>
                        <span class="font-bold text-slate-900">{{ $application->student_name }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">NISN Siswa:</span>
                        <span class="font-mono font-bold text-slate-900">{{ $application->nisn }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Asal Sekolah:</span>
                        <span class="font-bold text-slate-900">{{ $application->school_name }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Program Keahlian:</span>
                        <span class="font-bold text-slate-900">{{ $application->major }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Nomor WhatsApp:</span>
                        <span class="font-bold text-emerald-800">{{ $application->whatsapp_number }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-slate-500">Guru Pembimbing:</span>
                        <span class="font-bold text-slate-900">{{ $application->guardian_teacher_name ?: 'Menunggu Penugasan Sekolah' }}</span>
                    </div>
                </div>

                <!-- Info Mitra Industri -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-3 text-xs card-hover">
                    <h3 class="font-bold text-slate-900 border-b border-slate-200 pb-2.5 flex items-center text-sm">
                        <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Informasi Penempatan Industri:
                    </h3>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Perusahaan Mitra:</span>
                        <span class="font-bold text-slate-900">{{ $application->partner->company_name }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Sektor Industri:</span>
                        <span class="font-bold text-slate-900">{{ $application->partner->industry_sector }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Kota Penempatan:</span>
                        <span class="font-bold text-slate-900">{{ $application->partner->city }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Durasi Periode:</span>
                        <span class="font-bold text-slate-900">{{ $application->internship_period }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Instruktur DUDI:</span>
                        <span class="font-bold text-slate-900">{{ $application->partner->mentor_name ?: 'Supervisor Bengkel/Unit' }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-slate-500">Tautan Portofolio:</span>
                        @if($application->portfolio_url)
                            <a href="{{ $application->portfolio_url }}" target="_blank" rel="noopener" class="text-emerald-700 font-bold underline link-underline truncate max-w-[200px]">
                                {{ $application->portfolio_url }}
                            </a>
                        @else
                            <span class="text-slate-400">Tidak dilampirkan</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Notes & Remarks -->
            @if($application->notes)
                <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-900">
                    <span class="font-bold block mb-1">Catatan Verifikasi & Keterangan Tim BKK:</span>
                    <p class="leading-relaxed">{{ $application->notes }}</p>
                </div>
            @endif

            <!-- Action Buttons Strip -->
            <div class="pt-6 border-t border-slate-200 flex flex-wrap gap-3 justify-end no-print">
                <button type="button" onclick="window.print()" class="btn px-5 py-2.5 text-xs font-bold text-slate-800 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 flex items-center min-h-[44px] shadow-2xs">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak Bukti Registrasi
                </button>

                <button type="button" onclick="showWebhookSimulation('{{ $application->ticket_number }}')" class="btn px-5 py-2.5 text-xs font-bold text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-300 rounded-xl flex items-center min-h-[44px] shadow-2xs">
                    <svg class="w-4 h-4 mr-1.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Simulasi Webhook n8n / WA
                </button>

                <a href="{{ route('pkl.index') }}" class="btn px-5 py-2.5 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl flex items-center min-h-[44px]">
                    Kembali ke Katalog
                </a>
            </div>
        </div>

    @elseif($search)
        <!-- Search Not Found Empty State -->
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-md mx-auto space-y-4 no-print shadow-xs">
            <div class="w-14 h-14 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center mx-auto">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h2 class="text-lg font-bold text-slate-900">Tiket Tidak Ditemukan</h2>
            <p class="text-xs text-slate-500 leading-relaxed">
                Nomor tiket atau NISN <strong>"{{ $search }}"</strong> tidak terdaftar dalam pangkalan data. Pastikan nomor tiket diawali dengan "PKL-2026-".
            </p>
            <a href="{{ route('pkl.tracking') }}" class="btn inline-flex items-center px-4 py-2.5 text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-xl min-h-[44px]">
                Ulangi Pencarian
            </a>
        </div>
    @endif

    <!-- Recent Submissions for Easy Testing -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-4 no-print shadow-xs stagger-children">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-sm font-bold text-slate-900">Contoh Tiket Pengajuan untuk Pengujian Cepat:</h3>
                <p class="text-xs text-slate-500">Klik tombol "Buka" pada salah satu baris untuk memuat rincian tiket secara instan.</p>
            </div>
            <span class="text-xs text-slate-400">Total Terdaftar: {{ $recentApplications->count() }} Siswa</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-xs stagger-on-load">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 font-bold text-left">
                        <th class="py-3 px-3">No. Tiket</th>
                        <th class="py-3 px-3">Nama Siswa</th>
                        <th class="py-3 px-3">Sekolah & Jurusan</th>
                        <th class="py-3 px-3">Mitra Industri</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($recentApplications as $app)
                        <tr class="hover:bg-slate-50 transition-colors card-hover">
                            <td class="py-3 px-3 font-mono font-bold text-slate-900">{{ $app->ticket_number }}</td>
                            <td class="py-3 px-3 font-bold">{{ $app->student_name }}</td>
                            <td class="py-3 px-3">{{ $app->school_name }} ({{ $app->major }})</td>
                            <td class="py-3 px-3 font-medium">{{ $app->partner->company_name }}</td>
                            <td class="py-3 px-3">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $app->status_badge_class }}">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('pkl.tracking', ['ticket' => $app->ticket_number]) }}" class="btn px-3 py-1.5 text-xs font-bold text-emerald-800 bg-emerald-50 hover:bg-emerald-100 rounded-lg border border-emerald-300 inline-block min-h-[32px] leading-5">
                                    Buka
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-500">Belum ada pengajuan pendaftaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Simulasi Webhook JSON -->
<div id="webhook-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 no-print modal-overlay" role="dialog" aria-modal="true" aria-labelledby="webhook-title">
    <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-slate-200 overflow-hidden modal-content">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
            <div>
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Integrasi Webhook Otomasi</span>
                <h3 id="webhook-title" class="text-base font-black text-slate-900">Payload JSON untuk n8n & WhatsApp Gateway</h3>
            </div>
            <button type="button" onclick="closeWebhookModal()" class="text-slate-400 hover:text-slate-700 p-2 rounded-lg min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Tutup Modal Webhook">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-3">
            <p class="text-xs text-slate-600 leading-relaxed">
                Payload berikut adalah format JSON baku yang dikirimkan oleh backend Laravel ke Webhook n8n untuk diteruskan secara otomatis ke API WhatsApp (Fonnte) pada saat pendaftaran berhasil:
            </p>
            <pre id="webhook-json-content" class="bg-slate-900 text-emerald-400 p-4 rounded-xl text-xs font-mono overflow-x-auto max-h-80 border border-slate-800 leading-relaxed"></pre>
        </div>

        <div class="px-6 py-3 bg-slate-50 border-t border-slate-200 flex justify-end">
            <button type="button" onclick="closeWebhookModal()" class="px-4 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-100 min-h-[44px]">
                Tutup
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showWebhookSimulation(ticketNumber) {
        fetch(`/api/webhook-simulation/${ticketNumber}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('webhook-json-content').innerText = JSON.stringify(data, null, 2);
                const modal = document.getElementById('webhook-modal');
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                requestAnimationFrame(() => {
                    modal.classList.add('is-open');
                });
            })
            .catch(err => {
                console.error(err);
                alert('Gagal mengambil simulasi webhook.');
            });
    }

    function closeWebhookModal() {
        const modal = document.getElementById('webhook-modal');
        modal.classList.remove('is-open');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeWebhookModal();
        }
    });
</script>
@endpush
