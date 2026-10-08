<!DOCTYPE html>
<html lang="id" class="scroll-smooth h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EduVokasi PKL Hub') - Portal Penempatan Magang Industri SMK</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        navy: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: black !important; font-family: Arial, sans-serif !important; }
            .print-only { display: block !important; }
        }
        /* Custom scrollbar for clean modals */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* ===== LIGHTWEIGHT ANIMATIONS (No opacity:0 initial state) ===== */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Entrance Animations - only for explicit classes */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes pulseSoft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Utility Classes - only animate when explicitly added */
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.4s ease-out forwards; }
        .animate-shimmer { background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }
        .animate-pulse-soft { animation: pulseSoft 2s ease-in-out infinite; }

        /* Stagger delays */
        .stagger-1 { animation-delay: 0.05s; }
        .stagger-2 { animation-delay: 0.1s; }
        .stagger-3 { animation-delay: 0.15s; }
        .stagger-4 { animation-delay: 0.2s; }
        .stagger-5 { animation-delay: 0.25s; }
        .stagger-6 { animation-delay: 0.3s; }
        .stagger-7 { animation-delay: 0.35s; }
        .stagger-8 { animation-delay: 0.4s; }

        /* Micro-interactions */
        .btn { transition: transform 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease; }
        .btn:active:not(:disabled) { transform: scale(0.97); }
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1); }
        .link-underline { position: relative; }
        .link-underline::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background: currentColor; transition: width 0.2s ease; }
        .link-underline:hover::after { width: 100%; }

        /* Modal animations */
        .modal-overlay { opacity: 0; transition: opacity 0.2s ease; }
        .modal-overlay.is-open { opacity: 1; }
        .modal-content { opacity: 0; transform: scale(0.95) translateY(10px); transition: opacity 0.2s ease, transform 0.2s ease; }
        .modal-content.is-open { opacity: 1; transform: scale(1) translateY(0); }

        /* Mobile menu animation */
        .mobile-menu-enter { transform: translateX(100%); }
        .mobile-menu-enter-active { transform: translateX(0); transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .mobile-menu-exit { transform: translateX(0); }
        .mobile-menu-exit-active { transform: translateX(100%); transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1); }

        /* Backdrop animation */
        .backdrop-enter { opacity: 0; }
        .backdrop-enter-active { opacity: 1; transition: opacity 0.2s ease; }
        .backdrop-exit { opacity: 1; }
        .backdrop-exit-active { opacity: 0; transition: opacity 0.2s ease; }

        /* Loading skeleton */
        .skeleton { background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; border-radius: 0.5rem; }

        /* Focus visible polyfill */
        .focus-visible-ring:focus-visible { outline: none; box-shadow: 0 0 0 2px #fff, 0 0 0 4px #10b981; }

        /* Toast/notification slide */
        @keyframes slideInToast {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideOutToast {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(100%); }
        }
        .toast-enter { animation: slideInToast 0.3s ease-out forwards; }
        .toast-exit { animation: slideOutToast 0.3s ease-in forwards; }
    </style>
</head>
<body class="flex flex-col min-h-full font-sans antialiased text-slate-800 bg-slate-50 selection:bg-emerald-100 selection:text-emerald-900">

    <!-- Announcement Bar -->
    <div id="announcement-bar" class="bg-slate-900 text-white text-xs py-2 px-4 border-b border-slate-800 no-print" role="region" aria-label="Pengumuman">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-1 sm:gap-4 text-center sm:text-left">
            <div class="flex items-center gap-2 justify-center sm:justify-start">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0" aria-hidden="true"></span>
                <span class="font-medium text-slate-300">
                    Penerimaan PKL Gelombang 1 Tahun Ajaran 2026/2027:
                </span>
                <span class="text-white font-semibold">
                    10 Mitra Industri Resmi Membuka Kuota Magang
                </span>
            </div>
            <div class="text-slate-400 text-[11px] flex items-center justify-center gap-3">
                <span>Batas Pengajuan: 30 November 2026</span>
                <span class="text-slate-600 hidden sm:inline" aria-hidden="true">|</span>
                <a href="{{ route('pkl.tracking') }}" class="text-emerald-400 hover:text-emerald-300 underline font-medium">Lacak Status Tiket</a>
                <button type="button" id="announcement-close" class="ml-2 sm:ml-4 p-1 rounded text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500" aria-label="Tutup pengumuman">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    @php
        $isHome = request()->routeIs('pkl.index');
    @endphp
    <header id="main-navbar" class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-[72px]">
                <!-- Brand / Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('pkl.index') }}" class="flex items-center space-x-3 group focus:outline-none focus:ring-2 focus:ring-emerald-500 rounded-lg p-1">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white flex items-center justify-center font-extrabold text-xl shadow-sm shadow-emerald-500/20 flex-shrink-0">
                            V
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-base font-extrabold text-slate-900 tracking-tight block">EduVokasi PKL</span>
                                <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">SMK - DUDI</span>
                            </div>
                            <span class="text-xs text-slate-500 font-medium block">Pusat Informasi & Penempatan Magang</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-1" aria-label="Navigasi Utama">
                    <a href="{{ $isHome ? '#katalog-section' : route('pkl.index') . '#katalog-section' }}"
                       data-nav-id="katalog-section"
                       class="nav-item text-xs font-semibold px-3 py-2 rounded-lg transition-colors {{ $isHome ? 'text-emerald-700 bg-emerald-50' : 'text-slate-700 hover:text-emerald-600 hover:bg-slate-50' }} focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        Katalog Tempat PKL
                    </a>

                    <a href="{{ $isHome ? '#linimasa-section' : route('pkl.index') . '#linimasa-section' }}"
                       data-nav-id="linimasa-section"
                       class="nav-item text-xs font-semibold px-3 py-2 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        Linimasa Magang
                    </a>

                    <a href="{{ $isHome ? '#berkas-section' : route('pkl.index') . '#berkas-section' }}"
                       data-nav-id="berkas-section"
                       class="nav-item text-xs font-semibold px-3 py-2 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        Unduh Berkas Resmi
                    </a>

                    <a href="{{ $isHome ? '#faq-section' : route('pkl.index') . '#faq-section' }}"
                       data-nav-id="faq-section"
                       class="nav-item text-xs font-semibold px-3 py-2 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        Tanya Jawab (FAQ)
                    </a>

                    <a href="{{ route('pkl.tracking') }}"
                       data-nav-id="tracking"
                       class="nav-item text-xs font-semibold px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('pkl.tracking') ? 'text-emerald-700 bg-emerald-50 font-bold' : 'text-slate-700 hover:text-emerald-600 hover:bg-slate-50' }} focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        Lacak Pengajuan
                    </a>
                </nav>

                <!-- Desktop / Tablet Actions -->
                <div class="hidden sm:flex items-center space-x-2.5">
                    <a href="{{ route('pkl.tracking') }}" class="inline-flex items-center px-3.5 py-2 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 rounded-xl shadow-xs focus:outline-none focus:ring-2 focus:ring-slate-400 min-h-[44px]">
                        <svg class="w-3.5 h-3.5 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cek No Tiket
                    </a>
                    <a href="{{ $isHome ? '#katalog-section' : route('pkl.index') . '#katalog-section' }}" class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs hover:shadow focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all min-h-[44px]">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Pilih Tempat PKL
                    </a>
                </div>

                <!-- Mobile Menu Button (Hamburger) -->
                <div class="flex lg:hidden">
                    <button id="mobile-menu-btn" type="button" class="p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[44px] min-w-[44px] flex items-center justify-center transition-colors" aria-expanded="false" aria-label="Buka Menu Navigasi">
                        <!-- Closed icon (Hamburger) -->
                        <svg id="hamburger-icon" class="w-6 h-6 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <!-- Open icon (X) -->
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Backdrop -->
            <div id="mobile-menu-backdrop" class="hidden fixed inset-0 bg-slate-900/40 z-30 lg:hidden" aria-hidden="true"></div>

            <!-- Mobile Navigation Drawer -->
            <div id="mobile-menu" class="hidden lg:hidden fixed top-0 right-0 z-40 h-full w-full max-w-sm bg-white shadow-2xl border-l border-slate-200 overflow-y-auto transform transition-transform duration-300 ease-in-out" role="dialog" aria-modal="true" aria-label="Menu navigasi mobile">
                <div class="flex flex-col h-full">
                    <!-- Mobile Menu Header -->
                    <div class="flex items-center justify-between p-4 border-b border-slate-200 flex-shrink-0">
                        <h2 class="text-sm font-bold text-slate-900">Menu Navigasi</h2>
                        <button type="button" id="mobile-menu-close" class="p-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Tutup menu navigasi">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                <nav class="space-y-1" aria-label="Navigasi Mobile">
                    <a href="{{ $isHome ? '#katalog-section' : route('pkl.index') . '#katalog-section' }}"
                       data-nav-id="katalog-section"
                       class="mobile-nav-item block px-3.5 py-2.5 rounded-xl text-xs font-semibold {{ $isHome ? 'text-emerald-700 bg-emerald-50' : 'text-slate-800 hover:bg-slate-100' }}">
                        Katalog Tempat PKL
                    </a>
                    <a href="{{ $isHome ? '#linimasa-section' : route('pkl.index') . '#linimasa-section' }}"
                       data-nav-id="linimasa-section"
                       class="mobile-nav-item block px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-800 hover:bg-slate-100">
                        Linimasa & Tahapan Magang
                    </a>
                    <a href="{{ $isHome ? '#berkas-section' : route('pkl.index') . '#berkas-section' }}"
                       data-nav-id="berkas-section"
                       class="mobile-nav-item block px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-800 hover:bg-slate-100">
                        Unduh Berkas Resmi (Format Laporan & Jurnal)
                    </a>
                    <a href="{{ $isHome ? '#faq-section' : route('pkl.index') . '#faq-section' }}"
                       data-nav-id="faq-section"
                       class="mobile-nav-item block px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-800 hover:bg-slate-100">
                        Tanya Jawab Siswa (FAQ)
                    </a>
                    <a href="{{ route('pkl.tracking') }}"
                       data-nav-id="tracking"
                       class="mobile-nav-item block px-3.5 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('pkl.tracking') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-800 hover:bg-slate-100' }}">
                        Pelacakan Status Tiket Siswa
                    </a>
                </nav>

                <!-- Mobile Menu Footer with Action Buttons -->
                <div class="p-4 border-t border-slate-200 flex-shrink-0">
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('pkl.tracking') }}" class="py-2.5 px-3 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl text-center min-h-[44px] flex items-center justify-center">
                            Cek No Tiket
                        </a>
                        <a href="{{ $isHome ? '#katalog-section' : route('pkl.index') . '#katalog-section' }}" class="py-2.5 px-3 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl text-center min-h-[44px] flex items-center justify-center">
                            Pilih Tempat PKL
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Global Flash Notification -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full no-print">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 border-l-4 border-l-emerald-600 p-4 rounded-r-xl shadow-xs flex items-start space-x-3 mb-4" role="alert">
                <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1 text-xs text-emerald-900 font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 border-l-4 border-l-rose-600 p-4 rounded-r-xl shadow-xs flex items-start space-x-3 mb-4" role="alert">
                <svg class="w-5 h-5 text-rose-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1 text-xs text-rose-900">
                    <p class="font-bold">Mohon perbaiki data formulir pendaftaran Anda:</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-xs">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Body Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Rich Vocational Footer -->
    <footer class="bg-slate-900 text-slate-300 border-t border-slate-800 mt-20 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Column 1: Info Portal -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white font-bold flex items-center justify-center text-lg">
                            V
                        </div>
                        <span class="text-white font-extrabold text-lg">EduVokasi PKL Hub</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Sistem otomasi penempatan Praktik Kerja Lapangan (PKL) resmi untuk Sekolah Menengah Kejuruan. Terintegrasi dengan kurikulum vokasi nasional dan standar kemitraan DUDI 8+i.
                    </p>
                    <div class="pt-2 border-t border-slate-800 text-[11px] text-slate-500 space-y-1">
                        <p class="font-medium text-slate-400">Direktorat Pembinaan SMK & BKK</p>
                        <p>Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</p>
                    </div>
                </div>

                <!-- Column 2: Program Keahlian -->
                <div class="space-y-3">
                    <h3 class="text-xs font-bold text-white tracking-wider uppercase">Bidang Keahlian PKL</h3>
                    <ul class="space-y-2 text-xs">
                        <li>
                            <a href="{{ route('pkl.index', ['major' => 'RPL']) }}" class="hover:text-emerald-400 transition-colors flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Rekayasa Perangkat Lunak (RPL)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pkl.index', ['major' => 'TKJ']) }}" class="hover:text-emerald-400 transition-colors flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Teknik Komputer & Jaringan (TKJ)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pkl.index', ['major' => 'DKV']) }}" class="hover:text-emerald-400 transition-colors flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Desain Komunikasi Visual (DKV)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pkl.index', ['major' => 'TKRO']) }}" class="hover:text-emerald-400 transition-colors flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Teknik Kendaraan Ringan Otomotif (TKRO)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pkl.index', ['major' => 'AKL']) }}" class="hover:text-emerald-400 transition-colors flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Akuntansi & Keuangan Lembaga (AKL)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pkl.index', ['major' => 'DPIB']) }}" class="hover:text-emerald-400 transition-colors flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Desain Pemodelan Bangunan (DPIB)
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Dokumen & Panduan -->
                <div class="space-y-3">
                    <h3 class="text-xs font-bold text-white tracking-wider uppercase">Pusat Berkas & Dokumen</h3>
                    <ul class="space-y-2 text-xs">
                        <li>
                            <a href="{{ $isHome ? '#berkas-section' : route('pkl.index') . '#berkas-section' }}" class="hover:text-emerald-400 transition-colors">Format Jurnal Harian PKL</a>
                        </li>
                        <li>
                            <a href="{{ $isHome ? '#berkas-section' : route('pkl.index') . '#berkas-section' }}" class="hover:text-emerald-400 transition-colors">Template Laporan Akhir Praktik</a>
                        </li>
                        <li>
                            <a href="{{ $isHome ? '#berkas-section' : route('pkl.index') . '#berkas-section' }}" class="hover:text-emerald-400 transition-colors">Lembar Penilaian Instruktur DUDI</a>
                        </li>
                        <li>
                            <a href="{{ $isHome ? '#berkas-section' : route('pkl.index') . '#berkas-section' }}" class="hover:text-emerald-400 transition-colors">Surat Permohonan Izin Orang Tua</a>
                        </li>
                        <li>
                            <a href="{{ $isHome ? '#linimasa-section' : route('pkl.index') . '#linimasa-section' }}" class="hover:text-emerald-400 transition-colors">Panduan Keselamatan Kerja (K3)</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Kontak BKK & Helpdesk -->
                <div class="space-y-3">
                    <h3 class="text-xs font-bold text-white tracking-wider uppercase">Hubungan Industri (Hubin)</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Layanan konsultasi penempatan magang bagi siswa dan konfirmasi kemitraan industri:
                    </p>
                    <div class="space-y-1.5 text-xs text-slate-300">
                        <div class="flex items-center space-x-2">
                            <span class="text-emerald-400 font-semibold">Email:</span>
                            <span>hubin-vokasi@eduvokasi.sch.id</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-emerald-400 font-semibold">Layanan:</span>
                            <span>Senin - Jumat (07.30 - 16.00 WIB)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-emerald-400 font-semibold">Sekretariat:</span>
                            <span>Gedung BKK & Hubin Lantai 2</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-slate-800 mt-12 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-3">
                <p>&copy; {{ date('Y') }} EduVokasi PKL Hub. Seluruh hak cipta dilindungi undang-undang.</p>
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center text-emerald-400 font-medium text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-1.5"></span>
                        Sistem Penempatan Beroperasi Normal
                    </span>
                    <span>Versi Framework: Laravel 12</span>
                </div>
            </div>
        </div>
    </footer>

<!-- Interactive Navigation Scripts (Accessible Mobile Drawer, Focus Trap, Backdrop, ScrollSpy) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Elements
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const backdrop = document.getElementById('mobile-menu-backdrop');
            const closeBtn = document.getElementById('mobile-menu-close');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            // Announcement Bar Close
            const announcementBar = document.getElementById('announcement-bar');
            const announcementClose = document.getElementById('announcement-close');
            if (announcementClose && announcementBar) {
                announcementClose.addEventListener('click', () => {
                    announcementBar.style.display = 'none';
                    // Adjust header top position since announcement bar is gone
                    const header = document.getElementById('main-navbar');
                    if (header) header.style.top = '0';
                });
            }

            let lastFocusedElement = null;
            let focusTrapInterval = null;

            function openMobileMenu() {
                if (!menu || !btn || !backdrop) return;
                lastFocusedElement = document.activeElement;
                menu.classList.remove('hidden');
                backdrop.classList.remove('hidden');
                // Force reflow for animation
                requestAnimationFrame(() => {
                    menu.classList.remove('translate-x-full');
                    backdrop.classList.add('opacity-100');
                });
                btn.setAttribute('aria-expanded', 'true');
                if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
                if (closeIcon) closeIcon.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                // Focus trap: cycle focus within menu
                const focusableElements = menu.querySelectorAll(
                    'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'
                );
                if (focusableElements.length > 0) {
                    focusableElements[0].focus();
                    focusTrapInterval = setInterval(() => {
                        if (document.activeElement !== menu && !menu.contains(document.activeElement)) {
                            focusableElements[0].focus();
                        }
                    }, 100);
                }
            }

            function closeMobileMenu() {
                if (!menu || !btn || !backdrop) return;
                menu.classList.add('translate-x-full');
                backdrop.classList.remove('opacity-100');
                setTimeout(() => {
                    menu.classList.add('hidden');
                    backdrop.classList.add('hidden');
                }, 300);
                btn.setAttribute('aria-expanded', 'false');
                if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                if (closeIcon) closeIcon.classList.add('hidden');
                document.body.style.overflow = '';
                if (focusTrapInterval) {
                    clearInterval(focusTrapInterval);
                    focusTrapInterval = null;
                }
                // Restore focus to trigger button
                if (lastFocusedElement) {
                    lastFocusedElement.focus();
                    lastFocusedElement = null;
                }
            }

            if (btn && menu && backdrop) {
                // Initialize menu position for animation
                menu.classList.add('translate-x-full', 'transition-transform', 'duration-300', 'ease-in-out');
                backdrop.classList.add('transition-opacity', 'duration-300', 'opacity-0');

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
                    if (isExpanded) {
                        closeMobileMenu();
                    } else {
                        openMobileMenu();
                    }
                });

                if (closeBtn) {
                    closeBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        closeMobileMenu();
                    });
                }

                // Close mobile menu when clicking any link inside it
                const mobileLinks = menu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        closeMobileMenu();
                    });
                });

                // Close mobile menu when clicking backdrop
                backdrop.addEventListener('click', () => {
                    closeMobileMenu();
                });

                // Close on ESC key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        closeMobileMenu();
                    }
                });

                // Close on window resize to desktop
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 1024) {
                        closeMobileMenu();
                    }
                });
            }

            // Real-time ScrollSpy for active nav items on home page
            const navItems = document.querySelectorAll('.nav-item[data-nav-id]');
            const mobileNavItems = document.querySelectorAll('.mobile-nav-item[data-nav-id]');
            const sections = ['katalog-section', 'linimasa-section', 'berkas-section', 'faq-section'];

            function updateActiveNav() {
                // If on tracking page, don't override tracking active state
                if (window.location.pathname === '/tracking-pkl') {
                    return;
                }

                const scrollPosition = window.scrollY + 120;
                let currentSection = 'katalog-section';

                sections.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        const top = el.offsetTop;
                        const height = el.offsetHeight;
                        if (scrollPosition >= top && scrollPosition < top + height) {
                            currentSection = id;
                        }
                    }
                });

                // Update desktop nav
                navItems.forEach(item => {
                    const target = item.getAttribute('data-nav-id');
                    if (target === currentSection) {
                        item.classList.add('text-emerald-700', 'bg-emerald-50');
                        item.classList.remove('text-slate-700');
                    } else if (target !== 'tracking') {
                        item.classList.remove('text-emerald-700', 'bg-emerald-50');
                        item.classList.add('text-slate-700');
                    }
                });

                // Update mobile nav
                mobileNavItems.forEach(item => {
                    const target = item.getAttribute('data-nav-id');
                    if (target === currentSection) {
                        item.classList.add('text-emerald-700', 'bg-emerald-50');
                        item.classList.remove('text-slate-800');
                    } else if (target !== 'tracking') {
                        item.classList.remove('text-emerald-700', 'bg-emerald-50');
                        item.classList.add('text-slate-800');
                    }
                });
            }

            // Only run scroll listener if sections exist on this page
            if (document.getElementById('katalog-section')) {
                window.addEventListener('scroll', updateActiveNav, { passive: true });
                updateActiveNav();
            }

            // ===== LIGHTWEIGHT ANIMATIONS =====
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            
            if (!prefersReducedMotion) {
                // Counter Animation - simple version
                document.querySelectorAll('[data-counter]').forEach(el => {
                    const target = parseInt(el.dataset.counter, 10);
                    const duration = parseInt(el.dataset.duration, 10) || 1500;
                    const start = performance.now();
                    
                    function update(now) {
                        const progress = Math.min((now - start) / duration, 1);
                        const eased = 1 - Math.pow(1 - progress, 3);
                        const current = Math.floor(target * eased);
                        el.textContent = current.toLocaleString('id-ID');
                        if (progress < 1) requestAnimationFrame(update);
                        else el.textContent = target.toLocaleString('id-ID');
                    }
                    requestAnimationFrame(update);
                });

                // Staggered entrance for grid items on load
                document.querySelectorAll('.stagger-on-load').forEach(container => {
                    const items = container.children;
                    Array.from(items).forEach((item, i) => {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px)';
                        item.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, 100 + i * 80);
                    });
                });

                // Card hover (lift + glow)
                document.querySelectorAll('.card-hover').forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        card.style.transform = 'translateY(-6px)';
                        card.style.boxShadow = '0 25px 50px -12px rgb(16 185 129 / 0.25), 0 0 0 1px rgb(16 185 129 / 0.1)';
                    });
                    card.addEventListener('mouseleave', () => {
                        card.style.transform = '';
                        card.style.boxShadow = '';
                    });
                });

                // Smooth scroll for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        const targetId = this.getAttribute('href');
                        if (targetId === '#') return;
                        const target = document.querySelector(targetId);
                        if (target) {
                            e.preventDefault();
                            const headerOffset = 80;
                            const elementPosition = target.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                            
                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });
                            history.pushState(null, '', targetId);
                            target.setAttribute('tabindex', '-1');
                            target.focus({ preventScroll: true });
                        }
                    });
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
