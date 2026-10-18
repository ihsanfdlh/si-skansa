@extends('layouts.header')
@section('title', 'Detail Data Kelas')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Card Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Profile Banner -->
        <div class="bg-gradient-to-r from-amber-600 via-orange-600 to-rose-700 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shrink-0">
                        {{ substr($kelas->nama_kelas, 0, 3) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/20 text-xs font-semibold text-amber-100 mb-1 border border-white/20">
                            Rombel Kelas
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                            {{ $kelas->nama_kelas }}
                        </h1>
                        <p class="text-xs text-amber-100/90 font-medium">
                            Tingkat: {{ $kelas->tingkat }} &bull; T.A. {{ $kelas->tahun_ajaran }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" 
                       class="px-4 py-2.5 rounded-xl bg-white text-orange-700 hover:bg-orange-50 text-xs sm:text-sm font-bold shadow-md transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('kelas.index') }}" 
                       class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold border border-white/20 transition-all flex items-center gap-2">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Information List -->
        <div class="p-6 sm:p-8">
            <h2 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Informasi Rombel Kelas
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Nama Rombel</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $kelas->nama_kelas }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Tingkat</div>
                    <div class="text-sm font-semibold text-slate-800">Kelas {{ $kelas->tingkat }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Tahun Ajaran</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $kelas->tahun_ajaran }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Wali Kelas</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $kelas->walikelas ?? '-' }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Jurusan / Program Keahlian</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $kelas->jurusan ?? '-' }}</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
