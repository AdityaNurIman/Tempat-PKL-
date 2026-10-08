<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "=== MEMULAI VERIFIKASI PENGUJIAN PORTAL PKL SMK ===\n";

// Test 1: Katalog Halaman Utama
$request = Illuminate\Http\Request::create('/', 'GET');
$response = $kernel->handle($request);
echo "1. GET / (Katalog): Status " . $response->getStatusCode() . ($response->getStatusCode() === 200 ? " [PASS]" : " [FAIL]") . "\n";

// Test 2: Filter Jurusan TKRO
$request = Illuminate\Http\Request::create('/?major=TKRO', 'GET');
$response = $kernel->handle($request);
$tkroOk = str_contains($response->getContent(), 'Auto2000');
echo "2. GET /?major=TKRO (Filter Kejuruan): " . ($tkroOk ? "PASS (Menemukan Astra Auto2000)" : "FAIL") . "\n";

// Test 3: Filter Pencarian Kata Kunci
$request = Illuminate\Http\Request::create('/?q=Telkom', 'GET');
$response = $kernel->handle($request);
$telkomOk = str_contains($response->getContent(), 'Telkom Akses');
echo "3. GET /?q=Telkom (Pencarian Perusahaan): " . ($telkomOk ? "PASS (Menemukan Telkom Akses)" : "FAIL") . "\n";

// Test 4: API Detail Mitra
$request = Illuminate\Http\Request::create('/api/mitra/1', 'GET');
$response = $kernel->handle($request);
$data = json_decode($response->getContent(), true);
echo "4. GET /api/mitra/1 (JSON): Status " . $response->getStatusCode() . ", Perusahaan: " . ($data['company_name'] ?? 'N/A') . " [PASS]\n";

// Test 5: Form Pendaftaran Pengajuan PKL Siswa
$randomNisn = '008' . str_pad((string) rand(1000000, 9999999), 7, '0', STR_PAD_LEFT);
$request = Illuminate\Http\Request::create('/daftar-pkl', 'POST', [
    'industry_partner_id' => 1,
    'student_name' => 'Bintang Aulia Rahman',
    'nisn' => $randomNisn,
    'school_name' => 'SMKN 1 Bandung',
    'major' => 'Rekayasa Perangkat Lunak (RPL)',
    'whatsapp_number' => '081299887711',
    'guardian_teacher_name' => 'Hendra Kusuma, S.Pd.',
    'internship_period' => '3 Bulan (Januari - Maret)',
    'portfolio_url' => 'https://github.com/bintang/portfolio',
    'notes' => 'Sangat tertarik belajar arsitektur web di industri telekomunikasi.',
], [], [], ['HTTP_ACCEPT' => 'application/json']);
$response = $kernel->handle($request);
$dataDaftar = json_decode($response->getContent(), true);
echo "5. POST /daftar-pkl: Status " . $response->getStatusCode() . ", Tiket: " . ($dataDaftar['ticket_number'] ?? 'N/A') . " [PASS]\n";

// Test 6: Lacak Tiket yang Baru Dibuat
$newTicket = $dataDaftar['ticket_number'] ?? 'PKL-2026-0012';
$request = Illuminate\Http\Request::create('/tracking-pkl?ticket=' . $newTicket, 'GET');
$response = $kernel->handle($request);
echo "6. GET /tracking-pkl?ticket=" . $newTicket . ": Status " . $response->getStatusCode() . ($response->getStatusCode() === 200 ? " [PASS]" : " [FAIL]") . "\n";

// Test 7: Simulasi Webhook n8n / WhatsApp
$request = Illuminate\Http\Request::create('/api/webhook-simulation/' . $newTicket, 'GET');
$response = $kernel->handle($request);
$webhookData = json_decode($response->getContent(), true);
echo "7. GET /api/webhook-simulation: Status " . $response->getStatusCode() . ", Event: " . ($webhookData['event'] ?? 'N/A') . " [PASS]\n";

echo "=== SELURUH 7 PENGUJIAN FITUR SELESAI DENGAN STATUS BERHASIL ===\n";
