# DESIGN.md - Panduan Desain & Karakter Visual Portal PKL SMK

## Identitas & Konsep
- **Nama Platform**: EduVokasi PKL Hub (Sistem Informasi & Katalog Magang Industri SMK)
- **Target Pengguna**: Siswa SMK (pencari tempat PKL), Guru Pembimbing Sekolah, dan Mitra Industri (DUDI).
- **Dial**: ENERGY 2 / RHYTHM 2 / MOTION 1
  - *Energy 2*: Profesional, hangat, ramah pelajar vokasi, terstruktur seperti portal layanan publik modern.
  - *Rhythm 2*: Konsisten dengan hierarki informasi yang jelas antara navigasi, pencarian, kartu mitra, dan formulir aplikasi.
  - *Motion 1*: Interaksi mikro yang fungsional (hover kartu, transisi pembukaan modal detail dan filter pill).

## Palet Warna (Kontras Tinggi - Memenuhi WCAG AA)
- **Primary / Slate Dark**: `#0F172A` (Slate 900) - Teks utama, judul, dan elemen navigasi.
- **Secondary / Slate Medium**: `#334155` (Slate 700) - Teks keterangan dan label formulir.
- **Brand Accent / Emerald Vokasi**: `#059669` (Emerald 600) - Tombol aksi utama, lencana kuota aktif, dan indikator sukses.
- **Surface / Background**: `#F8FAFC` (Slate 50) & `#FFFFFF` (Putih murni).
- **Border / Pembatas**: `#E2E8F0` (Slate 200).
- **Status Badges**:
  - Kuota Tersedia: Hijau lembut (`bg-emerald-50 text-emerald-800 border-emerald-200`)
  - Kuota Terbatas: Amber hangat (`bg-amber-50 text-amber-800 border-amber-200`)
  - Terverifikasi DUDI: Biru sejuk (`bg-blue-50 text-blue-800 border-blue-200`)

## Tipografi
- Font Keluarga: `system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif`.
- Skala Font: Hierarki proporsional dari H1 (2rem/32px), H2 (1.5rem/24px), H3 (1.125rem/18px), hingga Body Text (0.9375rem/15px).
- Tidak menggunakan font monospace berlebihan atau huruf kapital dengan tracking ekstrim.

## Prinsip Konten & Anti-Slop
- Tanpa karakter em dash (gantikan dengan tanda koma, titik dua, atau kurung).
- Tanpa klaim hiperbolis atau buzzword kecerdasan buatan seperti "revolutionary", "seamless", dsb.
- Seluruh data mitra industri, kuota, persyaratan, dan jurusan SMK bersifat konkret dan masuk akal sesuai kurikulum vokasi Indonesia.
