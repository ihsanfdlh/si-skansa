<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI-SKANSA') &mdash; SMK Negeri 1 (SKANSA)</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                                950: '#0f172a',
                            }
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(241, 245, 249, 0.6);
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="h-full text-slate-800 antialiased bg-slate-50 flex flex-col min-h-screen">

    <!-- Mobile Overlay Backdrop -->
    <div id="sidebarBackdrop" 
         class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden"
         onclick="toggleMobileSidebar(false)">
    </div>

    <!-- SIDEBAR FOR DESKTOP & MOBILE -->
    <aside id="mainSidebar"
           class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-white flex flex-col transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 border-r border-slate-800/80 shadow-2xl lg:shadow-none">
        
        <!-- School Brand Header with Logo -->
        <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80 bg-slate-900/60 backdrop-blur-sm">
            <a href="{{ url('/') }}" class="flex items-center gap-3.5 group">
                <div class="relative shrink-0">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-500 via-indigo-600 to-blue-700 p-0.5 shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo SKANSA" class="w-full h-full object-contain rounded-[10px] bg-slate-900/40 p-1">
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-slate-900 rounded-full animate-pulse"></span>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="text-base font-extrabold tracking-tight text-white group-hover:text-blue-400 transition-colors flex items-center gap-1.5 truncate">
                        SMKN 1 SKANSA
                    </span>
                    <span class="text-xs text-slate-400 font-medium truncate">
                        Sistem Info Akademik
                    </span>
                </div>
            </a>

            <!-- Mobile Close Button -->
            <button type="button" 
                    onclick="toggleMobileSidebar(false)"
                    class="lg:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    aria-label="Tutup Menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- School Year / Academic Badge -->
        <div class="px-6 pt-5 pb-2">
            <div class="px-3.5 py-2 rounded-xl bg-slate-800/60 border border-slate-700/50 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Tahun Ajaran
                </span>
                <span class="font-bold text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded-md border border-blue-500/20">2026/2027</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto">
            <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400/90">
                Menu Utama
            </div>

            <!-- Link: Siswa -->
            @php $isSiswa = request()->routeIs('siswa.*'); @endphp
            <a href="{{ route('siswa.index') }}" 
               class="group flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isSiswa ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}">
                <div class="p-1.5 rounded-lg {{ $isSiswa ? 'bg-white/20 text-white' : 'text-blue-400 bg-slate-800/80 group-hover:bg-slate-700/80 group-hover:text-blue-300' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                    </svg>
                </div>
                <span>Data Siswa</span>
                @if($isSiswa)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Link: Guru -->
            @php $isGuru = request()->routeIs('guru.*'); @endphp
            <a href="{{ route('guru.index') }}" 
               class="group flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isGuru ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}">
                <div class="p-1.5 rounded-lg {{ $isGuru ? 'bg-white/20 text-white' : 'text-emerald-400 bg-slate-800/80 group-hover:bg-slate-700/80 group-hover:text-emerald-300' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span>Data Guru</span>
                @if($isGuru)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Link: Kelas -->
            @php $isKelas = request()->routeIs('kelas.*'); @endphp
            <a href="{{ route('kelas.index') }}" 
               class="group flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isKelas ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}">
                <div class="p-1.5 rounded-lg {{ $isKelas ? 'bg-white/20 text-white' : 'text-amber-400 bg-slate-800/80 group-hover:bg-slate-700/80 group-hover:text-amber-300' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span>Data Kelas</span>
                @if($isKelas)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Link: Jurusan -->
            @php $isJurusan = request()->routeIs('jurusan.*'); @endphp
            <a href="{{ route('jurusan.index') }}" 
               class="group flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isJurusan ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}">
                <div class="p-1.5 rounded-lg {{ $isJurusan ? 'bg-white/20 text-white' : 'text-purple-400 bg-slate-800/80 group-hover:bg-slate-700/80 group-hover:text-purple-300' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <span>Data Jurusan</span>
                @if($isJurusan)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Link: Pengajaran -->
            @php $isPengajaran = request()->routeIs('pengajaran.*'); @endphp
            <a href="{{ route('pengajaran.index') }}"
               class="group flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isPengajaran ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}">
                <div class="p-1.5 rounded-lg {{ $isPengajaran ? 'bg-white/20 text-white' : 'text-cyan-400 bg-slate-800/80 group-hover:bg-slate-700/80 group-hover:text-cyan-300' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5 5.755 5 4.168 5.477 3 6.253v13C4.168 18.477 5.755 18 7.5 18c1.746 0 3.332.477 4.5 1.253m0-13C13.168 5.477 14.755 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.245 18 16.5 18c-1.745 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span>Pengajaran</span>
                @if($isPengajaran)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Link: Nilai -->
            @php $isNilai = request()->routeIs('nilai.*'); @endphp
            <a href="{{ route('nilai.index') }}"
               class="group flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isNilai ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}">
                <div class="p-1.5 rounded-lg {{ $isNilai ? 'bg-white/20 text-white' : 'text-violet-400 bg-slate-800/80 group-hover:bg-slate-700/80 group-hover:text-violet-300' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span>Data Nilai</span>
                @if($isNilai)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Link: Orang Tua -->
            @php $isOrangtua = request()->routeIs('orangtua.*'); @endphp
            <a href="{{ route('orangtua.index') }}" 
               class="group flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isOrangtua ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}">
                <div class="p-1.5 rounded-lg {{ $isOrangtua ? 'bg-white/20 text-white' : 'text-rose-400 bg-slate-800/80 group-hover:bg-slate-700/80 group-hover:text-rose-300' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span>Data Orang Tua</span>
                @if($isOrangtua)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Section: Pintasan Cepat -->
            <div class="pt-6 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400/90">
                Pintasan Tambah
            </div>

            <div class="space-y-1">
                @if (Route::has('siswa.create'))
                <a href="{{ route('siswa.create') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                    <span>+ Tambah Siswa Baru</span>
                </a>
                @endif
                @if (Route::has('guru.create'))
                <a href="{{ route('guru.create') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>+ Tambah Guru Baru</span>
                </a>
                @endif
                @if (Route::has('kelas.create'))
                <a href="{{ route('kelas.create') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    <span>+ Tambah Kelas Baru</span>
                </a>
                @endif
            </div>
        </nav>

        <!-- Sidebar User Profile Footer -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-900/60">
            <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-800/40 border border-slate-700/40 hover:bg-slate-800/70 transition-colors">
                <div class="relative shrink-0">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                        AD
                    </div>
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-slate-900"></span>
                </div>
                <div class="flex flex-col min-w-0 flex-1">
                    <span class="text-sm font-semibold text-white truncate">Administrator</span>
                    <span class="text-[11px] text-slate-400 truncate">admin@skansa.sch.id</span>
                </div>
                <a href="{{ url('/') }}" title="Halaman Utama" class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-700/60 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </a>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="lg:pl-72 flex flex-col flex-1 min-h-screen">
        
        <!-- TOP NAVBAR -->
        <header class="sticky top-0 z-30 h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 shadow-xs flex items-center justify-between px-4 sm:px-6 lg:px-8">
            
            <!-- Left: Mobile Menu Toggle & Breadcrumb -->
            <div class="flex items-center gap-3.5">
                <!-- Hamburger Button (Mobile) -->
                <button type="button" 
                        onclick="toggleMobileSidebar(true)" 
                        class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 transition-all"
                        aria-label="Buka Menu Sidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Mobile School Brand Title -->
                <div class="flex items-center gap-2 lg:hidden">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-7 h-7 object-contain">
                    <span class="font-bold text-slate-900 text-sm tracking-tight">SI-SKANSA</span>
                </div>

                <!-- Desktop Breadcrumbs / Page Heading context -->
                <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ url('/') }}" class="hover:text-blue-600 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-800">@yield('title', 'Akademik')</span>
                </div>
            </div>

            <!-- Right: Search info, Indonesian Date Badge & Notification -->
            <div class="flex items-center gap-3">
                <!-- Today's Date Badge -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-medium border border-slate-200">
                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>
                        @php
                            $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][date('w')];
                            $bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'][date('n')];
                            echo $hari . ', ' . date('j') . ' ' . $bulan . ' ' . date('Y');
                        @endphp
                    </span>
                </div>

                <!-- Live Status Badge -->
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="hidden sm:inline">Sistem Aktif</span>
                </div>

                <!-- School Quick Info Button -->
                <div class="relative">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-xs shadow-md shadow-blue-500/20">
                        <span class="uppercase">SK</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- FLASH NOTIFICATIONS -->
        <div class="px-4 sm:px-6 lg:px-8 pt-4">
            @if (session()->has('success'))
                <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-xs mb-4 animate-fade-in" role="alert">
                    <div class="p-2 rounded-xl bg-emerald-500 text-white shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="flex-1 text-sm font-semibold">
                        {{ session()->get('success') }}
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 p-1.5 rounded-lg hover:bg-emerald-100/60 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="flex items-center gap-3 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 shadow-xs mb-4 animate-fade-in" role="alert">
                    <div class="p-2 rounded-xl bg-rose-500 text-white shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="flex-1 text-sm font-semibold">
                        {{ session()->get('error') }}
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 p-1.5 rounded-lg hover:bg-rose-100/60 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- MAIN PAGE CONTENT -->
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="mt-auto border-t border-slate-200 bg-white/70 backdrop-blur-xs py-4 px-4 sm:px-6 lg:px-8 text-xs text-slate-500">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    <p>&copy; {{ date('Y') }} <strong class="text-slate-800">SMK Negeri 1 (SKANSA)</strong> &bull; Sistem Informasi Akademik</p>
                </div>
                <div class="flex items-center gap-4 text-slate-400">
                    <span>Versi 2.0</span>
                    <span>&bull;</span>
                    <span class="text-slate-500 font-medium">Bisa! Hebat! Siap Kerja!</span>
                </div>
            </div>
        </footer>
    </div>

    <!-- Responsive Sidebar Toggle Script -->
    <script>
        function toggleMobileSidebar(open) {
            const sidebar = document.getElementById('mainSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (open) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('opacity-0', 'pointer-events-none');
                backdrop.classList.add('opacity-100');
                document.body.classList.add('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0', 'pointer-events-none');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                toggleMobileSidebar(false);
            }
        });
    </script>
</body>
</html>