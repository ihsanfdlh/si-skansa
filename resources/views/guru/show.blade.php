@extends('layouts.header')
@section('title', 'Detail Data Guru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Card Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Profile Banner -->
        <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-700 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shrink-0">
                        {{ strtoupper(substr($guru->nama, 0, 2)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/20 text-xs font-semibold text-emerald-100 mb-1 border border-white/20">
                            Tenaga Pendidik
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                            {{ $guru->nama }}
                        </h1>
                        <p class="text-xs text-emerald-100/90 font-medium font-mono">
                            NIP: {{ $guru->nip ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="{{ route('guru.edit', $guru->id_guru) }}" 
                       class="px-4 py-2.5 rounded-xl bg-white text-emerald-700 hover:bg-emerald-50 text-xs sm:text-sm font-bold shadow-md transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('guru.index') }}" 
                       class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold border border-white/20 transition-all flex items-center gap-2">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Information List -->
        <div class="p-6 sm:p-8">
            <h2 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi Biodata Guru
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">NIP / NUPTK</div>
                    <div class="text-sm font-semibold text-slate-800 font-mono">{{ $guru->nip }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Jenis Kelamin</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $guru->jenis_kelamin }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $guru->tempat_lahir }}, {{ $guru->tanggal_lahir }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Agama</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $guru->agama }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">No. Telepon / WhatsApp</div>
                    <div class="text-sm font-semibold text-slate-800 font-mono">{{ $guru->no_telp ?? '-' }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Alamat Tempat Tinggal</div>
                    <div class="text-sm text-slate-700 leading-relaxed">{{ $guru->alamat }}</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
