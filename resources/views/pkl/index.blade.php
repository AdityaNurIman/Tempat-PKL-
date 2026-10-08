@extends('layouts.app')

@section('title', 'Katalog Tempat PKL SMK & Kemitraan DUDI Terverifikasi')

@section('content')
<div class="space-y-16 pb-20">

    <!-- Hero & Search Header -->
    <section class="relative bg-gradient-to-b from-white via-slate-50 to-slate-100 border-b border-slate-200 py-16 sm:py-24 lg:py-32 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Hero Illustration -->
        <div class="absolute inset-0 bg-[url('https://picsum.photos/seed/eduvokasi-hero/1920/600.jpg')] bg-cover bg-center opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/70 via-slate-900/30 to-transparent"></div>

        <!-- Subtle Background Decorative Circles -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-100/40 rounded-full blur-3xl pointer-events-none animate-pulse-soft"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-teal-100/30 rounded-full blur-3xl pointer-events-none animate-pulse-soft" style="animation-delay: 1s;"></div>

        <div class="max-w-5xl mx-auto text-center space-y-5 relative z-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-100/80 text-emerald-800 border border-emerald-300 shadow-2xs backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                Penerimaan Praktik Kerja Lapangan Tahun Ajaran 2026/2027
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                Temukan Tempat PKL Industri & Bangun Pengalaman Kerja Nyata
            </h1>

            <p class="text-sm sm:text-base lg:text-lg text-slate-200 max-w-3xl mx-auto leading-relaxed">
                Kemitraan resmi Dunia Usaha Dunia Industri (DUDI) untuk siswa SMK. Kuota resmi terverifikasi, pembimbing tersertifikasi, alur pengajuan transparan, dan terhubung langsung dengan pihak sekolah.
            </p>

            <!-- Search & Multi-Filter Form Box -->
            <form action="{{ route('pkl.index') }}" method="GET" class="max-w-4xl mx-auto pt-4" id="search-form">
                <div class="bg-white/95 backdrop-blur-sm p-3 rounded-2xl shadow-lg border border-slate-200/50 flex flex-col md:flex-row gap-2.5 text-left">
                    <!-- Keyword search -->
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama perusahaan, keahlian, atau posisi..." class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm text-slate-900 placeholder-slate-400 bg-transparent rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                    </div>

                    <!-- Major filter in search bar -->
                    <div class="md:w-52">
                        <select name="major" class="w-full py-2.5 px-3 text-xs sm:text-sm text-slate-900 bg-white border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                            <option value="Semua">Semua Program Keahlian</option>
                            @foreach($popularMajors as $m)
                                <option value="{{ $m }}" {{ request('major') === $m ? 'selected' : '' }}>Jurusan {{ $m }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City filter -->
                    <div class="md:w-44">
                        <select name="city" class="w-full py-2.5 px-3 text-xs sm:text-sm text-slate-900 bg-white border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                            <option value="Semua">Semua Kota</option>
                            @foreach($cities as $c)
                                <option value="{{ $c }}" {{ request('city') === $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quota availability -->
                    <div class="md:w-40">
                        <select name="quota" class="w-full py-2.5 px-3 text-xs sm:text-sm text-slate-900 bg-white border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                            <option value="">Semua Kuota</option>
                            <option value="available" {{ request('quota') === 'available' ? 'selected' : '' }}>Masih Tersedia</option>
                        </select>
                    </div>

                    <button type="submit" class="btn px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold rounded-xl shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[44px] flex items-center justify-center">
                        Cari Tempat PKL
                    </button>
                </div>
            </form>

            <!-- Real Stats Strip -->
            <div class="pt-6 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto text-left">
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs card-hover">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Mitra Industri</span>
                        <span class="p-1 rounded-md bg-emerald-50 text-emerald-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </span>
                    </div>
                    <div class="text-2xl font-black text-slate-900 mt-1 counter" data-counter="{{ $stats['total_partners'] }}">0 Perusahaan</div>
                    <span class="text-[11px] text-emerald-700 font-medium">Terakreditasi DUDI</span>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs card-hover">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Total Kuota</span>
                        <span class="p-1 rounded-md bg-blue-50 text-blue-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </span>
                    </div>
                    <div class="text-2xl font-black text-slate-900 mt-1 counter" data-counter="{{ $stats['total_quota'] }}">0 Kursi</div>
                    <span class="text-[11px] text-slate-500 font-medium">Tahun Ajaran 2026</span>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs card-hover">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Sisa Kuota Terbuka</span>
                        <span class="p-1 rounded-md bg-emerald-50 text-emerald-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <div class="text-2xl font-black text-emerald-700 mt-1 counter" data-counter="{{ $stats['available_quota'] }}">0 Kursi</div>
                    <span class="text-[11px] text-emerald-800 font-medium">Bisa Didaftarkan Hari Ini</span>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs card-hover">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Tingkat Penempatan</span>
                        <span class="p-1 rounded-md bg-amber-50 text-amber-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </span>
                    </div>
                    <div class="text-2xl font-black text-slate-900 mt-1 counter" data-counter="{{ $stats['acceptance_rate'] }}">0%</div>
                    <span class="text-[11px] text-slate-500 font-medium">Siswa Berhasil Ditempatkan</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Catalog Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 scroll-mt-28" id="katalog-section">

        <!-- Program Keahlian Filter Bar -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs space-y-3">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Pilih Berdasarkan Program Keahlian (Jurusan)</h2>
                    <p class="text-xs text-slate-500">Klik salah satu jurusan untuk melihat mitra industri yang menyediakan kuota magang.</p>
                </div>

                @if(request('major') || request('q') || request('city') || request('quota'))
                    <a href="{{ route('pkl.index') }}" class="inline-flex items-center text-xs font-semibold text-rose-600 hover:text-rose-700 underline focus:outline-none focus:ring-2 focus:ring-rose-500">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reset Semua Filter
                    </a>
                @endif
            </div>

            <!-- Major Pills with Counts -->
            <div class="flex flex-wrap gap-2 pt-1">
                <a href="{{ route('pkl.index', array_merge(request()->except('major'), ['major' => 'Semua'])) }}"
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all min-h-[40px] inline-flex items-center gap-1.5 {{ (!request('major') || request('major') === 'Semua') ? 'bg-slate-900 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 border border-slate-200' }}">
                    <span>Semua Jurusan</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ (!request('major') || request('major') === 'Semua') ? 'bg-slate-800 text-slate-200' : 'bg-white text-slate-600' }}">{{ $stats['total_partners'] }}</span>
                </a>

                @foreach($popularMajors as $m)
                    <a href="{{ route('pkl.index', array_merge(request()->except('major'), ['major' => $m])) }}"
                       class="px-4 py-2 rounded-xl text-xs font-bold transition-all min-h-[40px] inline-flex items-center gap-1.5 {{ request('major') === $m ? 'bg-emerald-700 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 border border-slate-200' }}">
                        <span>{{ $m }}</span>
                        <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ request('major') === $m ? 'bg-emerald-800 text-white' : 'bg-white text-slate-600 border border-slate-200' }}">
                            {{ $majorCounts[$m] ?? 0 }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Catalog Header & Sort -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200">
            <div>
                <h2 class="text-xl font-black text-slate-900">
                    Daftar Tempat Magang Industri ({{ $partners->count() }} Mitra Aktif)
                </h2>
                <p class="text-xs text-slate-500">
                    Pilih mitra industri untuk mempelajari persyaratan kriteria dan mengajukan formulir secara langsung.
                </p>
            </div>

            <!-- Sort dropdown -->
            <form action="{{ route('pkl.index') }}" method="GET" class="flex items-center gap-2">
                @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                @if(request('major')) <input type="hidden" name="major" value="{{ request('major') }}"> @endif
                @if(request('city')) <input type="hidden" name="city" value="{{ request('city') }}"> @endif
                @if(request('quota')) <input type="hidden" name="quota" value="{{ request('quota') }}"> @endif

                <label for="sort-select" class="text-xs font-semibold text-slate-600 whitespace-nowrap">Urutkan:</label>
                <select id="sort-select" name="sort" onchange="this.form.submit()" class="py-1.5 px-3 text-xs font-medium text-slate-700 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="default" {{ request('sort') === 'default' ? 'selected' : '' }}>Terbaru</option>
                    <option value="quota_desc" {{ request('sort') === 'quota_desc' ? 'selected' : '' }}>Sisa Kuota Terbanyak</option>
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Nama Perusahaan (A - Z)</option>
                </select>
            </form>
        </div>

        <!-- Empty State vs Card Grid -->
        @if($partners->isEmpty())
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto space-y-4 shadow-xs">
                <div class="w-14 h-14 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Mitra Industri Tidak Ditemukan</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Tidak ada lowongan yang sesuai dengan kriteria kata kunci "{{ request('q') }}" atau filter jurusan "{{ request('major') }}". Silakan reset filter untuk melihat seluruh kuota.
                </p>
                <a href="{{ route('pkl.index') }}" class="inline-flex items-center px-4 py-2.5 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl min-h-[44px]">
                    Tampilkan Seluruh Mitra
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" role="list">
                @foreach($partners as $partner)
                    <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:border-emerald-300 hover:shadow-lg transition-all duration-200 group" role="listitem">
                        <!-- Image + Quota Badge -->
                        <div class="relative h-40 bg-slate-100">
                            <img src="https://picsum.photos/seed/pkl-{{ $partner->id }}/600/300.jpg"
                                 alt="{{ $partner->company_name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy"
                                 onerror="this.src='https://via.placeholder.com/600x300/10b981/ffffff?text=PKL+Partner'">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent to-transparent"></div>
                            <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[10px] font-bold text-white backdrop-blur-sm
                                {{ $partner->available_quota > 2 ? 'bg-emerald-600/90' : ($partner->available_quota > 0 ? 'bg-amber-600/90' : 'bg-slate-600/90') }}">
                                {{ $partner->available_quota > 0 ? 'Sisa ' . $partner->available_quota . ' Kuota' : 'Kuota Penuh' }}
                            </span>
                        </div>

                        <div class="p-5 space-y-4">
                            <!-- Header: Sector + Badge -->
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-emerald-400 font-black text-sm flex items-center justify-center shrink-0">
                                        {{ strtoupper(substr($partner->company_name, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[11px] font-semibold text-slate-500 truncate">{{ $partner->industry_sector }}</p>
                                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Mitra DUDI Terverifikasi</span>
                                    </div>
                                </div>
                            </div>

<!-- Name + Location -->
                            <div>
                                <h3 class="font-extrabold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-1">{{ $partner->company_name }}</h3>
                                <p class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="truncate">{{ $partner->city }}</span>
                                </p>
                            </div>

                            <!-- Quota Progress -->
                            <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                                <div class="flex justify-between text-[11px] font-medium mb-1.5">
                                    <span class="text-slate-600">Kapasitas</span>
                                    <span class="font-bold text-slate-900">{{ $partner->filled_quota }}/{{ $partner->total_quota }}</span>
                                </div>
                                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-600 rounded-full transition-all duration-500" style="width: {{ min(100, ($partner->filled_quota / max(1, $partner->total_quota)) * 100) }}%"></div>
                                </div>
                            </div>

                            <!-- Majors -->
                            <div>
                                <p class="text-[11px] font-semibold text-slate-500 mb-1.5">Jurusan Cocok:</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($partner->majors_list as $majorTag)
                                        <span class="text-xs font-medium text-slate-700 bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-200 transition-colors">{{ $majorTag }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Job Description -->
                            <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">{{ $partner->job_description }}</p>

                            <!-- Duration & Allowance -->
                            <div class="bg-emerald-50/40 border border-emerald-100 rounded-xl p-3 space-y-2">
                                <div class="flex items-center gap-2 text-xs text-slate-700">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                    <span class="font-medium">Durasi:</span>
                                    <span class="font-bold text-slate-900 ml-auto">{{ $partner->duration }}</span>
                                </div>
                                <div class="flex items-start gap-2 text-xs text-slate-700">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <span class="font-medium truncate">{{ $partner->allowance }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="px-5 py-4 bg-slate-50 border-t border-slate-100 flex gap-2">
                            <button onclick="openDetailModal({{ $partner->id }})" class="flex-1 py-2.5 px-3 text-xs font-bold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-400 transition-colors min-h-[44px]">
                                Detail & Syarat
                            </button>
                            @if($partner->available_quota > 0)
                                <button onclick="openApplyModal({{ $partner->id }}, '{{ addslashes($partner->company_name) }}')" class="px-5 py-2.5 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors min-h-[44px] whitespace-nowrap">
                                    Daftar PKL
                                </button>
                            @else
                                <button disabled class="px-5 py-2.5 text-xs font-bold text-slate-400 bg-slate-100 rounded-xl cursor-not-allowed min-h-[44px] whitespace-nowrap">Penuh</button>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Section Linimasa Magang (Interactive Timeline) -->
    <section class="bg-slate-900 text-white py-16 px-4 sm:px-6 lg:px-8 border-y border-slate-800 scroll-mt-28" id="linimasa-section">
        <div class="max-w-7xl mx-auto space-y-10">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-400 bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-800">
                    Standar Operasional Penempatan PKL
                </span>
                <h2 class="text-2xl sm:text-4xl font-black tracking-tight text-white">
                    Linimasa & Tahapan Pelaksanaan Magang Industri SMK
                </h2>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                    Panduan lengkap bagi peserta didik dan orang tua mengenai alur resmi mulai dari pemilihan tempat, bimbingan, monitoring, hingga sidang laporan.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 md:grid-cols-5 gap-6 relative">
                <!-- Connecting line -->
                <div class="hidden lg:block absolute top-[44px] left-1/2 -translate-x-1/2 w-[88%] h-0.5 bg-gradient-to-r from-transparent via-emerald-500/30 to-transparent z-0"></div>
                <!-- Step 1 -->
                <div class="bg-slate-800/80 p-5 rounded-2xl border border-slate-700 space-y-3 card-hover relative z-10 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500 text-slate-900 font-extrabold flex items-center justify-center text-sm mx-auto mb-2">
                        01
                    </div>
                    <h3 class="text-sm font-bold text-white text-center">Pra-PKL & Pendaftaran</h3>
                    <p class="text-xs text-slate-300 leading-relaxed text-center">
                        Siswa mengeksplorasi katalog mitra industri di portal ini, melengkapi berkas data diri, dan mengirim pengajuan tiket pendaftaran.
                    </p>
                    <span class="text-[11px] text-emerald-400 font-medium block text-center">Bulan 1 - 2</span>
                </div>

                <!-- Step 2 -->
                <div class="bg-slate-800/80 p-5 rounded-2xl border border-slate-700 space-y-3 card-hover relative z-10 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500 text-slate-900 font-extrabold flex items-center justify-center text-sm mx-auto mb-2">
                        02
                    </div>
                    <h3 class="text-sm font-bold text-white text-center">Verifikasi & Surat Tugas</h3>
                    <p class="text-xs text-slate-300 leading-relaxed text-center">
                        Tim BKK/Hubin sekolah memverifikasi nilai akademik dan menerbitkan Surat Pengantar Resmi untuk diserahkan ke kantor DUDI.
                    </p>
                    <span class="text-[11px] text-emerald-400 font-medium block text-center">Bulan 3</span>
                </div>

                <!-- Step 3 -->
                <div class="bg-slate-800/80 p-5 rounded-2xl border border-slate-700 space-y-3 card-hover relative z-10 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500 text-slate-900 font-extrabold flex items-center justify-center text-sm mx-auto mb-2">
                        03
                    </div>
                    <h3 class="text-sm font-bold text-white text-center">Orientasi & K3 Industri</h3>
                    <p class="text-xs text-slate-300 leading-relaxed text-center">
                        Siswa hadir di perusahaan, menerima pembekalan Keselamatan & Kesehatan Kerja (K3), pengenalan budaya 5S, dan penugasan mentor.
                    </p>
                    <span class="text-[11px] text-emerald-400 font-medium block text-center">Awal Masa Praktik</span>
                </div>

                <!-- Step 4 -->
                <div class="bg-slate-800/80 p-5 rounded-2xl border border-slate-700 space-y-3 card-hover relative z-10 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500 text-slate-900 font-extrabold flex items-center justify-center text-sm mx-auto mb-2">
                        04
                    </div>
                    <h3 class="text-sm font-bold text-white text-center">Logbook & Supervisi</h3>
                    <p class="text-xs text-slate-300 leading-relaxed text-center">
                        Siswa mengisi jurnal kegiatan harian, bimbingan tugas teknis, dan kunjungan monitoring berkala oleh guru pembimbing sekolah.
                    </p>
                    <span class="text-[11px] text-emerald-400 font-medium block text-center">Masa Pelaksanaan</span>
                </div>

                <!-- Step 5 -->
                <div class="bg-slate-800/80 p-5 rounded-2xl border border-slate-700 space-y-3 card-hover relative z-10 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500 text-slate-900 font-extrabold flex items-center justify-center text-sm mx-auto mb-2">
                        05
                    </div>
                    <h3 class="text-sm font-bold text-white text-center">Ujian Sidang & Sertifikat</h3>
                    <p class="text-xs text-slate-300 leading-relaxed text-center">
                        Penarikan siswa, presentasi laporan di hadapan penguji, serta penerbitan Sertifikat Kompetensi Industri resmi dari DUDI.
                    </p>
                    <span class="text-[11px] text-emerald-400 font-medium block text-center">Akhir Masa Magang</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Pusat Unduhan Berkas Resmi (Document Center) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8" id="berkas-section">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Pusat Dokumen Resmi</span>
                <h2 class="text-2xl font-black text-slate-900 mt-1">Unduh Template Berkas & Format Laporan PKL</h2>
                <p class="text-xs text-slate-500 mt-0.5">Seluruh format baku sesuai pedoman Direktorat SMK Kemendikbudristek.</p>
            </div>
            <span class="text-xs text-slate-500 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                Terakhir Diperbarui: September 2026
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Doc 1 -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs space-y-3 flex flex-col justify-between card-hover">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-xs">
                        DOCX
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Format Laporan Akhir PKL</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Struktur baku laporan (Cover, Bab I Pendahuluan, Bab II Gambaran Umum DUDI, Bab III Pembahasan Kompetensi, Bab IV Penutup).
                    </p>
                </div>
                <button type="button" onclick="downloadSampleDoc('Format_Laporan_PKL_SMK_2026.docx')" class="btn w-full py-2 px-3 text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-xl flex items-center justify-center min-h-[44px] transition-colors">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Template (.docx)
                </button>
            </div>

            <!-- Doc 2 -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs space-y-3 flex flex-col justify-between card-hover">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                        PDF
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Buku Jurnal & Logbook Harian</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lembar pencatatan kegiatan harian, kehadiran, paraf pembimbing industri, dan dokumentasi foto kegiatan teknis.
                    </p>
                </div>
                <button type="button" onclick="downloadSampleDoc('Buku_Jurnal_Logbook_PKL_2026.pdf')" class="btn w-full py-2 px-3 text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-xl flex items-center justify-center min-h-[44px] transition-colors">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Lembar Jurnal (.pdf)
                </button>
            </div>

            <!-- Doc 3 -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs space-y-3 flex flex-col justify-between card-hover">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                        PDF
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Form Penilaian Instruktur DUDI</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Rubrik evaluasi aspek disiplin, keterampilan teknis, inisiatif, dan keselamatan kerja untuk penentuan nilai rapor sekolah.
                    </p>
                </div>
                <button type="button" onclick="downloadSampleDoc('Form_Penilaian_Instruktur_DUDI.pdf')" class="btn w-full py-2 px-3 text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-xl flex items-center justify-center min-h-[44px] transition-colors">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Rubrik Nilai (.pdf)
                </button>
            </div>

            <!-- Doc 4 -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs space-y-3 flex flex-col justify-between card-hover">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-xs">
                        PDF
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Surat Izin & Persetujuan Ortu</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Formulir pernyataan izin orang tua/wali siswa untuk mengikuti kegiatan magang industri di lokasi penempatan terkait.
                    </p>
                </div>
                <button type="button" onclick="downloadSampleDoc('Surat_Izin_Orang_Tua_PKL.pdf')" class="btn w-full py-2 px-3 text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-xl flex items-center justify-center min-h-[44px] transition-colors">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Surat Izin (.pdf)
                </button>
            </div>
        </div>
    </section>

    <!-- Section Tips & Panduan Sukses Seleksi Magang -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="text-center max-w-3xl mx-auto space-y-2">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Wawasan Vokasi</span>
            <h2 class="text-2xl font-black text-slate-900">Panduan Lolos Seleksi & Sukses PKL di Industri</h2>
            <p class="text-xs text-slate-600">Kiat praktis agar permohonan magang Anda cepat disetujui oleh manajemen DUDI.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-white to-slate-50 p-6 rounded-2xl border border-slate-200 shadow-2xs space-y-2 card-hover">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-bold text-xs mb-3">
                    01
                </div>
                <h3 class="text-sm font-bold text-slate-900">Sertakan Portofolio Hasil Praktik</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Industri lebih memprioritaskan siswa yang menyertakan bukti karya nyata (repository GitHub untuk RPL, dokumentasi topologi untuk TKJ, atau feed desain untuk DKV) dibanding nilai teori saja.
                </p>
            </div>

            <div class="bg-gradient-to-br from-white to-slate-50 p-6 rounded-2xl border border-slate-200 shadow-2xs space-y-2 card-hover">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-bold text-xs mb-3">
                    02
                </div>
                <h3 class="text-sm font-bold text-slate-900">Patuhi Disiplin Kerja & Budaya 5S</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Budaya industri menuntut ketepatan waktu hadir, kerapian seragam praktik, serta penerapan Seiri, Seiton, Seiso, Seiketsu, Shitsuke (Ringkas, Rapi, Resik, Rawat, Rajin) di lingkungan bengkel/kantor.
                </p>
            </div>

            <div class="bg-gradient-to-br from-white to-slate-50 p-6 rounded-2xl border border-slate-200 shadow-2xs space-y-2 card-hover">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-bold text-xs mb-3">
                    03
                </div>
                <h3 class="text-sm font-bold text-slate-900">Komunikasi Proaktif dengan Pembimbing</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Jangan ragu bertanya jika instruksi teknis belum dipahami. Catat setiap masukan instruktur DUDI ke dalam buku catatan saku dan laporkan kemajuan harian secara teratur.
                </p>
            </div>
        </div>
    </section>

    <!-- Section FAQ (Tanya Jawab Seputar PKL) -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" id="faq-section">
        <div class="text-center space-y-2">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Tanya Jawab</span>
            <h2 class="text-2xl font-black text-slate-900">Pertanyaan yang Sering Diajukan Siswa</h2>
            <p class="text-xs text-slate-600">Jawaban seputar prosedur, hak, dan kewajiban peserta magang industri.</p>
        </div>

        <div class="space-y-3" id="faq-container">
            @php
                $faqs = [
                    [
                        'id' => 1,
                        'question' => 'Apakah peserta PKL mendapatkan uang saku atau fasilitas transport?',
                        'answer' => 'Kebijakan kompensasi bergantung pada ketentuan masing-masing mitra industri (DUDI). Sebagian besar mitra dalam katalog menyediakan uang transport bulanan, makan siang di kantin industri, serta seragam kerja resmi. Rincian fasilitas dapat Anda lihat pada kartu masing-masing perusahaan.'
                    ],
                    [
                        'id' => 2,
                        'question' => 'Bagaimana jika kuota di perusahaan yang saya minati sudah penuh?',
                        'answer' => 'Jika kuota mitra tujuan telah terisi penuh, Anda disarankan memilih mitra alternatif lain yang membuka kuota pada jurusan yang sama melalui filter jurusan di atas. Anda juga dapat berkonsultasi langsung ke ruang BKK/Hubin sekolah untuk penempatan kemitraan khusus.'
                    ],
                    [
                        'id' => 3,
                        'question' => 'Apakah siswa diperbolehkan memilih lokasi magang di luar kota?',
                        'answer' => 'Diperbolehkan, asalkan telah mendapatkan persetujuan tertulis dari orang tua/wali serta pihak sekolah bersedia melakukan monitoring (baik daring maupun kunjungan langsung). Siswa yang magang di luar daerah wajib memastikan akomodasi tempat tinggal yang aman.'
                    ],
                    [
                        'id' => 4,
                        'question' => 'Bagaimana prosedur jika siswa berhalangan hadir atau sakit saat magang?',
                        'answer' => 'Siswa wajib memberitahu pembimbing industri (mentor DUDI) dan guru pembimbing sekolah selambat-lambatnya pukul 07.30 pagi dengan menyertakan surat keterangan dokter resmi. Kehadiran akan disesuaikan pada logbook harian.'
                    ],
                ];
            @endphp

            @foreach($faqs as $faq)
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-2xs card-hover group">
                    <button type="button" onclick="toggleFaq({{ $faq['id'] }})" class="btn w-full p-4 text-left flex items-center justify-between text-xs sm:text-sm font-bold text-slate-900 focus:outline-none min-h-[44px] hover:bg-slate-50">
                        <span>{{ $faq['question'] }}</span>
                        <svg id="faq-icon-{{ $faq['id'] }}" class="w-4 h-4 text-slate-500 transform transition-transform duration-200 group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="faq-answer-{{ $faq['id'] }}" class="p-4 pt-0 text-xs text-slate-600 leading-relaxed border-t border-slate-100 hidden transition-all duration-200 ease-out bg-slate-50/50">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

<!-- Modal 1: Detail Mitra Industri (Tabs Inside) -->
<div id="detail-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 modal-overlay" role="dialog" aria-modal="true" aria-labelledby="detail-title">
    <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-slate-200 overflow-hidden modal-content">
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
            <div>
                <span id="modal-sector" class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider block">Sektor Industri</span>
                <h3 id="modal-company" class="text-lg font-black text-slate-900">Nama Perusahaan</h3>
            </div>
            <button type="button" onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-400 min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Tutup Jendela Rincian">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Quick Badges -->
        <div class="px-6 py-3 bg-slate-100/70 border-b border-slate-200 grid grid-cols-3 gap-2 text-xs">
            <div>
                <span class="text-slate-500 block text-[10px]">Kota:</span>
                <span id="modal-city" class="font-bold text-slate-900">Bandung</span>
            </div>
            <div>
                <span class="text-slate-500 block text-[10px]">Sisa Kuota:</span>
                <span id="modal-quota" class="font-bold text-emerald-700">Tersedia</span>
            </div>
            <div>
                <span class="text-slate-500 block text-[10px]">Durasi:</span>
                <span id="modal-duration" class="font-bold text-slate-900">3 Bulan</span>
            </div>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 space-y-4 max-h-[65vh] overflow-y-auto text-xs text-slate-700">
            <!-- Address -->
            <div>
                <h4 class="font-bold text-slate-900 mb-1 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    Alamat Lengkap Perusahaan:
                </h4>
                <p id="modal-address" class="text-slate-600 leading-relaxed bg-slate-50 p-2.5 rounded-lg border border-slate-200"></p>
            </div>

            <!-- Job Description -->
            <div>
                <h4 class="font-bold text-slate-900 mb-1 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Tugas & Lingkup Praktik Kerja Siswa:
                </h4>
                <p id="modal-jobdesc" class="text-slate-600 leading-relaxed bg-slate-50 p-2.5 rounded-lg border border-slate-200"></p>
            </div>

            <!-- Requirements -->
            <div>
                <h4 class="font-bold text-slate-900 mb-1 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Kriteria & Syarat Berkas Pendaftaran:
                </h4>
                <p id="modal-requirements" class="text-slate-600 leading-relaxed bg-slate-50 p-2.5 rounded-lg border border-slate-200"></p>
            </div>

            <!-- Allowance -->
            <div>
                <h4 class="font-bold text-slate-900 mb-1 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Fasilitas & Tunjangan Praktik:
                </h4>
                <p id="modal-allowance" class="text-slate-600 leading-relaxed bg-slate-50 p-2.5 rounded-lg border border-slate-200"></p>
            </div>

            <!-- Mentor & Contact -->
            <div class="pt-2 border-t border-slate-200 flex flex-col sm:flex-row justify-between text-slate-600 bg-slate-100/50 p-3 rounded-xl gap-2">
                <div>
                    <span class="text-slate-500 block text-[10px]">Pembimbing Lapangan DUDI:</span>
                    <strong id="modal-mentor" class="text-slate-900"></strong>
                </div>
                <div>
                    <span class="text-slate-500 block text-[10px]">Email Kemitraan:</span>
                    <strong id="modal-email" class="text-slate-900"></strong>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end gap-3">
            <button type="button" onclick="closeDetailModal()" class="px-4 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-100 min-h-[44px]">
                Tutup
            </button>
            <button id="modal-btn-apply" type="button" class="px-5 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs min-h-[44px]">
                Daftar ke Mitra Ini
            </button>
        </div>
    </div>
</div>

<!-- Modal 2: Formulir Pendaftaran PKL Siswa -->
<div id="apply-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 modal-overlay" role="dialog" aria-modal="true" aria-labelledby="apply-title">
    <div class="bg-white rounded-2xl max-w-xl w-full shadow-2xl border border-slate-200 overflow-hidden modal-content">
        <!-- Form Header -->
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
            <div>
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Formulir Pendaftaran Siswa</span>
                <h3 id="apply-title" class="text-lg font-black text-slate-900">Pengajuan Tempat PKL</h3>
            </div>
            <button type="button" onclick="closeApplyModal()" class="text-slate-400 hover:text-slate-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-400 min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Tutup Formulir">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Form Tag -->
        <form action="{{ route('pkl.daftar') }}" method="POST" id="form-daftar-pkl" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            <input type="hidden" name="industry_partner_id" id="input-partner-id" value="">

            <!-- Nama Mitra Terpilih -->
            <div class="bg-emerald-50 border border-emerald-200 p-3 rounded-xl flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-emerald-800 font-semibold block">Perusahaan Tujuan:</span>
                    <span id="apply-company-name" class="text-sm font-extrabold text-emerald-950 block">PT Telkom Akses</span>
                </div>
                <span class="px-2 py-1 rounded bg-emerald-600 text-white text-[10px] font-bold">Kuota Tersedia</span>
            </div>

            <!-- Nama Siswa & NISN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="student_name" class="block text-xs font-bold text-slate-800 mb-1">
                        Nama Lengkap Siswa <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="student_name" id="student_name" required placeholder="Contoh: Ahmad Maulana" class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[40px]">
                </div>
                <div>
                    <label for="nisn" class="block text-xs font-bold text-slate-800 mb-1">
                        NISN (10 Digit Angka) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nisn" id="nisn" required maxlength="10" placeholder="Contoh: 0081293847" class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[40px]">
                </div>
            </div>

            <!-- Asal Sekolah & Jurusan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="school_name" class="block text-xs font-bold text-slate-800 mb-1">
                        Asal Sekolah SMK <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="school_name" id="school_name" required placeholder="Contoh: SMKN 1 Cimahi" class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[40px]">
                </div>
                <div>
                    <label for="major" class="block text-xs font-bold text-slate-800 mb-1">
                        Jurusan / Kompetensi <span class="text-rose-500">*</span>
                    </label>
                    <select name="major" id="major" required class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white min-h-[40px]">
                        <option value="">Pilih Jurusan Anda...</option>
                        <option value="Rekayasa Perangkat Lunak (RPL)">Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="Teknik Komputer dan Jaringan (TKJ)">Teknik Komputer dan Jaringan (TKJ)</option>
                        <option value="Desain Komunikasi Visual (DKV)">Desain Komunikasi Visual (DKV)</option>
                        <option value="Teknik Kendaraan Ringan Otomotif (TKRO)">Teknik Kendaraan Ringan Otomotif (TKRO)</option>
                        <option value="Akuntansi dan Keuangan Lembaga (AKL)">Akuntansi dan Keuangan Lembaga (AKL)</option>
                        <option value="Desain Pemodelan Bangunan (DPIB)">Desain Pemodelan Bangunan (DPIB)</option>
                    </select>
                </div>
            </div>

            <!-- WhatsApp & Guru Pembimbing -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="whatsapp_number" class="block text-xs font-bold text-slate-800 mb-1">
                        Nomor WhatsApp Siswa <span class="text-rose-500">*</span>
                    </label>
                    <input type="tel" name="whatsapp_number" id="whatsapp_number" required placeholder="Contoh: 081234567890" class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[40px]">
                    <span class="text-[10px] text-slate-500">Notifikasi status tiket dikirim ke nomor ini.</span>
                </div>
                <div>
                    <label for="guardian_teacher_name" class="block text-xs font-bold text-slate-800 mb-1">
                        Nama Guru Pembimbing Sekolah
                    </label>
                    <input type="text" name="guardian_teacher_name" id="guardian_teacher_name" placeholder="Contoh: Drs. Bambang Haryanto" class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[40px]">
                </div>
            </div>

            <!-- Periode & Portofolio Link -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="internship_period" class="block text-xs font-bold text-slate-800 mb-1">
                        Pilihan Periode Magang <span class="text-rose-500">*</span>
                    </label>
                    <select name="internship_period" id="internship_period" required class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white min-h-[40px]">
                        <option value="3 Bulan (Januari - Maret)">3 Bulan (Januari - Maret)</option>
                        <option value="3 Bulan (April - Juni)">3 Bulan (April - Juni)</option>
                        <option value="6 Bulan (Januari - Juni)">6 Bulan (Januari - Juni)</option>
                    </select>
                </div>
                <div>
                    <label for="portfolio_url" class="block text-xs font-bold text-slate-800 mb-1">
                        Tautan Portofolio / CV Digital
                    </label>
                    <input type="url" name="portfolio_url" id="portfolio_url" placeholder="https://github.com/... atau Google Drive" class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[40px]">
                </div>
            </div>

            <!-- Catatan Pengantar -->
            <div>
                <label for="notes" class="block text-xs font-bold text-slate-800 mb-1">
                    Catatan Motivasi / Minat Khusus
                </label>
                <textarea name="notes" id="notes" rows="2" placeholder="Tuliskan minat Anda mengikuti magang di mitra industri ini..." class="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
            </div>

            <!-- Buttons -->
            <div class="pt-3 border-t border-slate-200 flex justify-end gap-3">
                <button type="button" onclick="closeApplyModal()" class="px-4 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-100 min-h-[44px]">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs focus:outline-none focus:ring-2 focus:ring-emerald-500 min-h-[44px]">
                    Kirim Pengajuan PKL
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    // Modal Functions with Keyboard Accessibility (Escape key)
    function openDetailModal(partnerId) {
        fetch(`/api/mitra/${partnerId}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('modal-sector').innerText = data.industry_sector;
                document.getElementById('modal-company').innerText = data.company_name;
                document.getElementById('modal-city').innerText = data.city;
                document.getElementById('modal-quota').innerText = `Sisa ${data.available_quota} dari ${data.total_quota} Kursi`;
                document.getElementById('modal-duration').innerText = data.duration;
                document.getElementById('modal-address').innerText = data.address;
                document.getElementById('modal-jobdesc').innerText = data.job_description;
                document.getElementById('modal-requirements').innerText = data.requirements;
                document.getElementById('modal-allowance').innerText = data.allowance;
                document.getElementById('modal-mentor').innerText = data.mentor_name || 'Instruktur Lapangan DUDI';
                document.getElementById('modal-email').innerText = data.contact_email || 'bkk@eduvokasi.sch.id';

                const applyBtn = document.getElementById('modal-btn-apply');
                if (data.available_quota > 0) {
                    applyBtn.style.display = 'inline-block';
                    applyBtn.onclick = () => {
                        closeDetailModal();
                        openApplyModal(data.id, data.company_name);
                    };
                } else {
                    applyBtn.style.display = 'none';
                }

                const modal = document.getElementById('detail-modal');
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                // Trigger animation
                requestAnimationFrame(() => {
                    modal.classList.add('is-open');
                });
            })
            .catch(err => {
                console.error('Gagal memuat rincian mitra:', err);
                alert('Gagal mengambil data mitra. Silakan muat ulang halaman.');
            });
    }

    function closeDetailModal() {
        const modal = document.getElementById('detail-modal');
        modal.classList.remove('is-open');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }

    function openApplyModal(partnerId, companyName) {
        document.getElementById('input-partner-id').value = partnerId;
        document.getElementById('apply-company-name').innerText = companyName;
        const modal = document.getElementById('apply-modal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            modal.classList.add('is-open');
        });
    }

    function closeApplyModal() {
        const modal = document.getElementById('apply-modal');
        modal.classList.remove('is-open');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }

    // FAQ Accordion Toggle
    function toggleFaq(id) {
        const answer = document.getElementById(`faq-answer-${id}`);
        const icon = document.getElementById(`faq-icon-${id}`);
        const card = answer.closest('.group');
        if (answer.classList.contains('hidden')) {
            answer.classList.remove('hidden');
            icon.classList.add('rotate-180');
            if (card) card.classList.add('group-open');
        } else {
            answer.classList.add('hidden');
            icon.classList.remove('rotate-180');
            if (card) card.classList.remove('group-open');
        }
    }

    // Simulated sample document download
    function downloadSampleDoc(filename) {
        const dummyContent = `=== EDUVOKASI PKL HUB - DOKUMEN RESMI ===\nNama Berkas: ${filename}\nFormat Standar Kurikulum Merdeka Vokasi SMK.\nSilakan gunakan template ini untuk keperluan bimbingan dan pelaporan kegiatan magang industri.`;
        const blob = new Blob([dummyContent], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }

    // Keyboard navigation (ESC key closes open modal)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeDetailModal();
            closeApplyModal();
        }
    });
</script>
@endpush
</div>
