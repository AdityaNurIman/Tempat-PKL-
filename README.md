# EduVokasi PKL Hub - Portal Penempatan Magang Industri SMK

Aplikasi berbasis **Laravel 12** yang dirancang sebagai jembatan kemitraan antara Sekolah Menengah Kejuruan (SMK) dan Dunia Usaha Dunia Industri (DUDI) untuk proses eksplorasi tempat PKL, pendaftaran online, dan pelacakan status penempatan.

---

## Fitur Utama

1. **Katalog Mitra Industri (DUDI) Terverifikasi**
   - Menampilkan daftar mitra industri resmi dengan data riil (PT Telkom Akses, Astra Auto2000, Studio Kreatif DKV, KAP Akuntan Publik, Fintech Dev, Arsitektur DPIB).
   - Filter cepat berdasarkan Program Keahlian: **RPL**, **TKJ**, **DKV**, **TKRO**, **AKL**, dan **DPIB**.
   - Filter ketersediaan kuota (Semua vs Masih Ada Kuota).
   - Pencarian kata kunci multi-parameter (nama perusahaan, bidang usaha, kota).

2. **Modal Interaktif Rincian & Persyaratan Magang**
   - Menampilkan deskripsi pekerjaan praktik siswa di industri, fasilitas/uang saku, pembimbing lapangan bersertifikat, dan kriteria akademik.

3. **Formulir Pengajuan PKL Siswa**
   - Formulir pendaftaran terintegrasi langsung dengan database SQLite/MySQL.
   - Validasi data ketat: Nama, 10 digit NISN, Asal Sekolah, Jurusan, Nomor WhatsApp, Guru Pembimbing, Periode Magang, dan Tautan Portofolio.
   - Pengecekan otomatis sisa kuota dan proteksi duplikasi pengajuan dengan NISN yang sama.
   - Pembuatan nomor tiket registrasi unik otomatis (contoh: `PKL-2026-0004`).

4. **Pelacakan Status Pengajuan (Tracking Ticket)**
   - Siswa dapat mengecek status hanya dengan memasukkan Nomor Tiket atau NISN.
   - *Stepper Progress Bar*:
     - Tahap 1: Pendaftaran Berkas
     - Tahap 2: Verifikasi Sekolah & BKK
     - Tahap 3: Konfirmasi Penerimaan Industri DUDI
   - Tombol cetak bukti tanda terima pendaftaran (`window.print()`).

5. **Simulasi Webhook n8n & WhatsApp Gateway (Fonnte)**
   - Menyediakan endpoint simulasi JSON payload (`/api/webhook-simulation/{ticket}`) untuk pengujian alur otomatisasi n8n dan Fonnte WhatsApp Gateway.

---

## Cara Menjalankan Proyek

1. Masuk ke direktori proyek:
   ```powershell
   cd portal-pkl-smk
   ```

2. Jalankan server lokal Laravel:
   ```powershell
   php artisan serve
   ```

3. Buka browser pada alamat:
   ```
   http://127.0.0.1:8000
   ```

---

## Pengujian Otomatis

Proyek ini telah dilengkapi dengan skrip verifikasi otomatis:
```powershell
php verify_portal.php
```
Seluruh 7 skenario pengujian (katalog, filter jurusan, pencarian kata kunci, API detail mitra, form pendaftaran, tracking status, dan webhook JSON) telah teruji **PASS 100%**.
