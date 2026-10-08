<?php

namespace Database\Seeders;

use App\Models\IndustryPartner;
use App\Models\PklApplication;
use Illuminate\Database\Seeder;

class IndustryPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'company_name' => 'PT Telkom Akses (Regional Network Operations)',
                'industry_sector' => 'Telekomunikasi & Jaringan Fiber Optic',
                'city' => 'Bandung, Jawa Barat',
                'address' => 'Jl. Lembong No. 11, Braga, Sumur Bandung',
                'vocational_majors' => 'TKJ, RPL',
                'total_quota' => 6,
                'filled_quota' => 2,
                'allowance' => 'Uang transport bulanan, makan siang, sertifikat industri resmi',
                'duration' => '3 Bulan (Januari - Maret)',
                'requirements' => 'Siswa aktif SMK kelas XI atau XII jurusan TKJ/RPL. Memahami dasar routing switching, crimping kabel UTP & fiber optic, atau dasar pemrograman web. Nilai produktif minimal 78. Membawa laptop sendiri.',
                'job_description' => 'Membantu teknisi lapangan dalam instalasi jaringan FTTH (Fiber to the Home), konfigurasi OLT/ONT, monitoring jaringan di NOC, dan pencatatan tiket gangguan pada sistem operasional.',
                'mentor_name' => 'Bambang Triyadi, S.T. (Senior Network Engineer)',
                'contact_email' => 'magang.telkomakses@dudi-vokasi.id',
                'is_verified' => true,
            ],
            [
                'company_name' => 'PT Astra International Tbk (Auto2000 Pasteur)',
                'industry_sector' => 'Otomotif & Servis Kendaraan Ringan',
                'city' => 'Bandung, Jawa Barat',
                'address' => 'Jl. Dr. Djunjunan No. 192, Pasteur, Sukajadi',
                'vocational_majors' => 'TKRO, TBSM',
                'total_quota' => 5,
                'filled_quota' => 1,
                'allowance' => 'Uang saku harian, seragam bengkel resmi, makan siang, asuransi keselamatan kerja',
                'duration' => '6 Bulan (Januari - Juni)',
                'requirements' => 'Siswa SMK kelas XI atau XII jurusan Teknik Kendaraan Ringan Otomotif. Menguasai prosedur servis berkala 10.000 - 40.000 km, penggunaan scanner OBD-II, dan kedisiplinan 5S/5R.',
                'job_description' => 'Pendampingan mekanik teknisi dalam servis berkala mesin bensin/hybrid, pemeriksaan sistem rem, tune-up EFI, balancing ban, dan pengisian checklist inspeksi pra-penyerahan kendaraan.',
                'mentor_name' => 'Hendra Gunawan (Service Workshop Supervisor)',
                'contact_email' => 'training.auto2000@astra-vokasi.co.id',
                'is_verified' => true,
            ],
            [
                'company_name' => 'Studio Imaji Citra Visual (Digital Creative Agency)',
                'industry_sector' => 'Desain Komunikasi Visual & Multimedia',
                'city' => 'Jakarta Selatan, DKI Jakarta',
                'address' => 'Jl. Kemang Raya No. 45B, Mampang Prapatan',
                'vocational_majors' => 'DKV, Animasi, DMM',
                'total_quota' => 4,
                'filled_quota' => 3,
                'allowance' => 'Uang saku bulanan, akses kursus industri, sertifikat portofolio proyek klien',
                'duration' => '3 Bulan (Februari - April)',
                'requirements' => 'Siswa SMK jurusan DKV atau Multimedia. Mahir mengoperasikan Adobe Illustrator, Photoshop, Figma, atau Premiere Pro. Menyertakan tautan portofolio desain atau motion grafis.',
                'job_description' => 'Mengerjakan aset visual konten media sosial klien, layout materi promosi digital, editing video pendek edukasi, dan membantu persiapan sesi fotografi produk.',
                'mentor_name' => 'Dewi Anggraini, S.Ds. (Art Director & Creative Lead)',
                'contact_email' => 'intern@imajicitra.studio',
                'is_verified' => true,
            ],
            [
                'company_name' => 'Kantor Akuntan Publik (KAP) Anwar & Rekan',
                'industry_sector' => 'Jasa Keuangan, Perpajakan & Audit',
                'city' => 'Surabaya, Jawa Timur',
                'address' => 'Jl. Basuki Rahmat No. 88, Tegalsari',
                'vocational_majors' => 'AKL',
                'total_quota' => 3,
                'filled_quota' => 1,
                'allowance' => 'Uang transport bulanan, bimbingan langsung praktisi akuntansi, sertifikat magang',
                'duration' => '3 Bulan (Januari - Maret)',
                'requirements' => 'Siswa SMK program Akuntansi dan Keuangan Lembaga (AKL). Teliti, menguasai siklus akuntansi manual dan software akuntansi (MYOB / Accurate / Spreadsheet).',
                'job_description' => 'Pencatatan bukti transaksi kas masuk dan keluar, rekonsiliasi bank sederhana, pengarsipan berkas audit perpajakan, dan verifikasi faktur pajak standar.',
                'mentor_name' => 'Siti Nurhaliza, S.E., Ak., CA (Senior Auditor)',
                'contact_email' => 'karir.magang@kapanwar.co.id',
                'is_verified' => true,
            ],
            [
                'company_name' => 'PT Solusi Finansial Mandiri (Fintech Software House)',
                'industry_sector' => 'Teknologi Informasi & Software Development',
                'city' => 'Yogyakarta, D.I. Yogyakarta',
                'address' => 'Jl. Kaliurang KM 6, Sleman',
                'vocational_majors' => 'RPL, SIJA',
                'total_quota' => 5,
                'filled_quota' => 2,
                'allowance' => 'Uang saku bulanan, snack & kopi harian, bimbingan git flow dan code review mingguan',
                'duration' => '6 Bulan (Januari - Juni)',
                'requirements' => 'Siswa SMK jurusan Rekayasa Perangkat Lunak. Memahami dasar HTML, CSS, JavaScript, dan framework PHP (Laravel) atau basis data MySQL. Memiliki akun GitHub aktif.',
                'job_description' => 'Slicing antarmuka web dari Figma ke Blade/Tailwind, penulisan unit testing sederhana, perbaikan bug minor pada dashboard internal, dan integrasi API RESTful.',
                'mentor_name' => 'Fajar Pratama, M.Kom. (Engineering Manager)',
                'contact_email' => 'talent.intern@solusifinansial.tech',
                'is_verified' => true,
            ],
            [
                'company_name' => 'PT Citra Graha Arsitektur & Interior',
                'industry_sector' => 'Konstruksi & Desain Pemodelan Bangunan',
                'city' => 'Semarang, Jawa Tengah',
                'address' => 'Jl. Pemuda No. 120, Sekayu',
                'vocational_majors' => 'DPIB, BKP',
                'total_quota' => 4,
                'filled_quota' => 1,
                'allowance' => 'Uang saku bulanan, fasilitas komputer kerja workshop, bimbingan sertifikasi AutoCAD',
                'duration' => '3 Bulan (Maret - Mei)',
                'requirements' => 'Siswa SMK jurusan Desain Pemodelan dan Informasi Bangunan (DPIB). Mampu membaca gambar teknik, mengoperasikan AutoCAD 2D atau SketchUp dasar.',
                'job_description' => 'Membantu penyusunan gambar kerja arsitektur (denah, tampak, potongan), pembuatan model 3D visualisasi interior, dan penghitungan volume Rencana Anggaran Biaya (RAB) dasar.',
                'mentor_name' => 'Ir. Eko Prasetyo (Lead Drafter & Project Architect)',
                'contact_email' => 'studio@citragraha.co.id',
                'is_verified' => true,
            ],
            [
                'company_name' => 'PT Denso Manufacturing Indonesia (Plant Cikarang)',
                'industry_sector' => 'Manufaktur Presisi & Komponen Elektronik Otomotif',
                'city' => 'Bekasi, Jawa Barat',
                'address' => 'Kawasan Industri MM2100, Cikarang Barat',
                'vocational_majors' => 'TKRO, TEI, TP',
                'total_quota' => 8,
                'filled_quota' => 3,
                'allowance' => 'Uang saku industri manufaktur, makan siang kantin, bus jemputan karyawan, sertifikat K3',
                'duration' => '6 Bulan (Januari - Juni)',
                'requirements' => 'Siswa SMK kelas XI atau XII jurusan Otomotif atau Elektronika Industri. Disiplin tinggi, mematuhi standar keselamatan kerja K3, tidak buta warna, dan siap rotasi shift.',
                'job_description' => 'Mempelajari lini perakitan komponen injeksi bahan bakar dan radiator, inspeksi kualitas akhir (Quality Control), pengoperasian alat ukur vernier caliper dan dial indicator.',
                'mentor_name' => 'Agus Priyanto, S.T. (Production & Training Section Head)',
                'contact_email' => 'vokasi.intern@denso-indonesia.co.id',
                'is_verified' => true,
            ],
            [
                'company_name' => 'Bank Syariah Mandiri Sejahtera (KC Merdeka)',
                'industry_sector' => 'Perbankan Syariah & Layanan Keuangan Mikro',
                'city' => 'Bandung, Jawa Barat',
                'address' => 'Jl. Merdeka No. 56, Babakan Ciamis, Sumur Bandung',
                'vocational_majors' => 'AKL, PBS',
                'total_quota' => 4,
                'filled_quota' => 0,
                'allowance' => 'Uang transport bulanan, seragam operasional magang, pembekalan perbankan syariah',
                'duration' => '3 Bulan (Februari - April)',
                'requirements' => 'Siswa SMK program Akuntansi atau Perbankan Syariah. Berpenampilan rapi, ramah, menguasai pencatatan debit kredit dasar, dan pengoperasian Microsoft Excel.',
                'job_description' => 'Membantu frontliner dalam penerimaan berkas nasabah, validasi slip setoran dan penarikan, pengarsipan dokumen akad pembiayaan, dan input data transaksi harian.',
                'mentor_name' => 'Ratna Mutia, S.E.I. (Operational Manager)',
                'contact_email' => 'sdm.kcbandung@banksyariah.co.id',
                'is_verified' => true,
            ],
            [
                'company_name' => 'PT Media Nusantara Penyiaran (Studio Kreatif)',
                'industry_sector' => 'Penyiaran Televisi, Live Streaming & Konten Digital',
                'city' => 'Jakarta Barat, DKI Jakarta',
                'address' => 'Jl. Kebon Jeruk Raya No. 12, Palmerah',
                'vocational_majors' => 'DKV, Broadcasting, Multimedia',
                'total_quota' => 5,
                'filled_quota' => 1,
                'allowance' => 'Uang saku produksi, akses peralatan kamera broadcast, portofolio tayangan program',
                'duration' => '3 Bulan (Maret - Mei)',
                'requirements' => 'Siswa jurusan DKV atau Broadcasting. Memahami teknik dasar tata cahaya studio (lighting), framing kamera DSLR/Broadcast, dan dasar audio mixer.',
                'job_description' => 'Membantu kru produksi dalam penataan lampu studio rekaman, operator kamera cadangan saat siaran langsung podcast pendidikan, dan logging klip video wawancara.',
                'mentor_name' => 'Dicky Firmansyah (Production Broadcast Lead)',
                'contact_email' => 'magang.studio@mediatv-vokasi.id',
                'is_verified' => true,
            ],
            [
                'company_name' => 'RSUD Kota Sehat (Instalasi Jaringan & SIMRS)',
                'industry_sector' => 'Pelayanan Kesehatan & Sistem Informasi Rumah Sakit',
                'city' => 'Bogor, Jawa Barat',
                'address' => 'Jl. Pajajaran No. 80, Bogor Timur',
                'vocational_majors' => 'TKJ, RPL',
                'total_quota' => 4,
                'filled_quota' => 2,
                'allowance' => 'Uang saku dinas kesehatan, makan siang, kartu akses ruangan medis, sertifikat RSUD',
                'duration' => '3 Bulan (Januari - Maret)',
                'requirements' => 'Siswa SMK jurusan TKJ atau RPL. Memahami dasar instalasi LAN rumah sakit, konfigurasi printer jaringan, dan etika kerahasiaan data rekam medis pasien.',
                'job_description' => 'Membantu tim IT RSUD dalam perawatan PC unit poliklinik, pengecekan sambungan access point WiFi ruang rawat, serta pemeliharaan sistem antrean pasien online.',
                'mentor_name' => 'Irfan Maulana, S.Kom. (Kepala Seksi IT & SIMRS)',
                'contact_email' => 'it.rsud@kotasehat.go.id',
                'is_verified' => true,
            ],
        ];

        foreach ($partners as $partnerData) {
            $partner = IndustryPartner::firstOrCreate(
                ['company_name' => $partnerData['company_name']],
                $partnerData
            );

            // Tambahkan contoh pendaftaran riil
            if ($partner->company_name === 'PT Telkom Akses (Regional Network Operations)') {
                PklApplication::firstOrCreate(
                    ['ticket_number' => 'PKL-2026-0012'],
                    [
                        'industry_partner_id' => $partner->id,
                        'student_name' => 'Muhammad Rizky Pratama',
                        'nisn' => '0081293847',
                        'school_name' => 'SMKN 1 Cimahi',
                        'major' => 'Teknik Komputer dan Jaringan',
                        'whatsapp_number' => '081288776655',
                        'guardian_teacher_name' => 'Drs. Agus Sunarya',
                        'internship_period' => '3 Bulan (Januari - Maret)',
                        'portfolio_url' => 'https://github.com/mrizky-tkj/network-lab',
                        'status' => 'accepted',
                        'notes' => 'Surat tugas sekolah terlampir, telah lulus seleksi wawancara teknis dasar.',
                    ]
                );

                PklApplication::firstOrCreate(
                    ['ticket_number' => 'PKL-2026-0015'],
                    [
                        'industry_partner_id' => $partner->id,
                        'student_name' => 'Fathan Al Farisi',
                        'nisn' => '0089384721',
                        'school_name' => 'SMKN 4 Bandung',
                        'major' => 'Rekayasa Perangkat Lunak',
                        'whatsapp_number' => '081399887766',
                        'guardian_teacher_name' => 'Ika Rahmawati, S.Pd.',
                        'internship_period' => '3 Bulan (Januari - Maret)',
                        'portfolio_url' => 'https://github.com/fathanal/web-inventory',
                        'status' => 'review_school',
                        'notes' => 'Menunggu tanda tangan surat pengantar dari kepala program keahlian.',
                    ]
                );
            }

            if ($partner->company_name === 'PT Astra International Tbk (Auto2000 Pasteur)') {
                PklApplication::firstOrCreate(
                    ['ticket_number' => 'PKL-2026-0018'],
                    [
                        'industry_partner_id' => $partner->id,
                        'student_name' => 'Gilang Ramadhan',
                        'nisn' => '0087766554',
                        'school_name' => 'SMKN 6 Bandung',
                        'major' => 'Teknik Kendaraan Ringan Otomotif',
                        'whatsapp_number' => '082122334455',
                        'guardian_teacher_name' => 'Budi Santoso, S.T.',
                        'internship_period' => '6 Bulan (Januari - Juni)',
                        'portfolio_url' => null,
                        'status' => 'accepted',
                        'notes' => 'Telah mengikuti pembekalan K3 bengkel dan seragam kerja telah dibagikan.',
                    ]
                );
            }
        }
    }
}
