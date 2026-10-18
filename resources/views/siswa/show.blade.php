@extends('layouts.header')
@section('title', 'Detail Data Siswa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Card Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Profile Banner -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-700 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shrink-0">
                        {{ strtoupper(substr($siswa->nama, 0, 2)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/20 text-xs font-semibold text-blue-100 mb-1 border border-white/20">
                            Peserta Didik Aktif
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                            {{ $siswa->nama }}
                        </h1>
                        <p class="text-xs text-blue-100/90 font-medium">
                            Jenis Kelamin: {{ $siswa->jenis_kelamin }} &bull; Agama: {{ $siswa->agama }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" 
                       class="px-4 py-2.5 rounded-xl bg-white text-blue-700 hover:bg-blue-50 text-xs sm:text-sm font-bold shadow-md transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('siswa.index') }}" 
                       class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold border border-white/20 transition-all flex items-center gap-2">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Information List -->
        <div class="p-6 sm:p-8">
            <h2 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi Biodata Siswa
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- Jurusan Siswa -->
                <div class="p-4 rounded-2xl bg-purple-50/70 border border-purple-100">
                    <div class="text-xs text-purple-700 font-bold uppercase tracking-wider mb-1">Jurusan / Program Keahlian</div>
                    <div class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        @if($siswa->jurusan)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-purple-600 text-white font-mono">
                                {{ $siswa->jurusan->kode_jurusan ?? '-' }}
                            </span>
                            <span>{{ $siswa->jurusan->nama }}</span>
                        @else
                            <span class="text-slate-400 italic">Belum diatur</span>
                        @endif
                    </div>
                </div>

                <!-- Kelas Siswa -->
                <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-100">
                    <div class="text-xs text-amber-700 font-bold uppercase tracking-wider mb-1">Kelas / Rombel</div>
                    <div class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        @if($siswa->kelas)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-amber-500 text-white">
                                {{ $siswa->kelas->nama_kelas }}
                            </span>
                            <span class="text-xs text-slate-500">(Tingkat {{ $siswa->kelas->tingkat }})</span>
                        @else
                            <span class="text-slate-400 italic">Belum terdaftar di kelas manapun</span>
                        @endif
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Jenis Kelamin</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $siswa->jenis_kelamin }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Agama</div>
                    <div class="text-sm font-semibold text-slate-800">{{ $siswa->agama }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">No. Telepon / WhatsApp</div>
                    <div class="text-sm font-semibold text-slate-800 font-mono">{{ $siswa->no_telp ?? '-' }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Orang Tua / Wali Terdaftar</div>
                    <div class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                        <span>{{ $siswa->orangtua->nama ?? 'Belum terhubung' }}</span>
                        @if($siswa->orangtua && $siswa->orangtua->no_telp)
                            <span class="text-xs text-slate-400 font-mono">(HP: {{ $siswa->orangtua->no_telp }})</span>
                        @endif
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Alamat Tempat Tinggal</div>
                    <div class="text-sm text-slate-700 leading-relaxed">{{ $siswa->alamat }}</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
