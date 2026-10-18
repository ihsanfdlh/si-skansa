@extends('layouts.header')
@section('title', 'Detail Data Jurusan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Card Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Profile Banner -->
        <div class="bg-gradient-to-r from-purple-700 via-indigo-700 to-blue-800 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shrink-0">
                        {{ strtoupper(substr($jurusan->kode_jurusan ?? $jurusan->nama, 0, 2)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/20 text-xs font-semibold text-purple-100 mb-1 border border-white/20">
                            Konsentrasi Keahlian
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                            {{ $jurusan->nama }}
                        </h1>
                        <p class="text-xs text-purple-100/90 font-medium font-mono">
                            Kode: {{ $jurusan->kode_jurusan ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="{{ route('jurusan.edit', $jurusan->id_jurusan) }}" 
                       class="px-4 py-2.5 rounded-xl bg-white text-purple-700 hover:bg-purple-50 text-xs sm:text-sm font-bold shadow-md transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('jurusan.index') }}" 
                       class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold border border-white/20 transition-all flex items-center gap-2">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Information List -->
        <div class="p-6 sm:p-8">
            <h2 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
                Informasi Program Keahlian
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Kode Jurusan</div>
                    <div class="text-sm font-semibold text-slate-800 font-mono">{{ $jurusan->kode_jurusan ?? '-' }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Status Jurusan</div>
                    <div class="text-sm font-semibold text-emerald-600 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Aktif / Terakreditasi
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Nama Program Keahlian</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $jurusan->nama }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Kepala Program Keahlian (Guru)</div>
                    <div class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                        <span>{{ $jurusan->guru->nama ?? 'Belum ditentukan' }}</span>
                        @if($jurusan->guru && $jurusan->guru->nip)
                            <span class="text-xs text-slate-400 font-mono">(NIP: {{ $jurusan->guru->nip }})</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
