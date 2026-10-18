@extends('layouts.header')
@section('title', 'Edit Data Jurusan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Card Form Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Header Banner Form -->
        <div class="bg-gradient-to-r from-purple-700 via-indigo-700 to-blue-800 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-purple-100 border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        Perbarui Program Keahlian
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        Edit Data Jurusan: {{ $jurusan->nama }}
                    </h1>
                    <p class="text-xs sm:text-sm text-purple-100/90">
                        Perbarui kode jurusan, nama program, atau kepala program keahlian.
                    </p>
                </div>

                <a href="{{ route('jurusan.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold backdrop-blur-md border border-white/20 transition-all self-start sm:self-auto shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Daftar</span>
                </a>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Kode Jurusan -->
                <div class="space-y-1.5">
                    <label for="kode_jurusan" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Kode Jurusan
                    </label>
                    <input id="kode_jurusan" 
                           type="text" 
                           name="kode_jurusan" 
                           value="{{ old('kode_jurusan', $jurusan->kode_jurusan) }}" 
                           placeholder="Contoh: RPL / TKJ / DKV" 
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all shadow-2xs font-mono uppercase @error('kode_jurusan') border-rose-400 bg-rose-50/30 @enderror">
                    @error('kode_jurusan')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Jurusan -->
                <div class="space-y-1.5">
                    <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Nama Jurusan / Program Keahlian <span class="text-rose-500">*</span>
                    </label>
                    <input id="nama" 
                           type="text" 
                           name="nama" 
                           value="{{ old('nama', $jurusan->nama) }}" 
                           placeholder="Contoh: Rekayasa Perangkat Lunak" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all shadow-2xs @error('nama') border-rose-400 bg-rose-50/30 @enderror">
                    @error('nama')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kepala Jurusan -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="id_kepalajurusan" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Kepala Program Keahlian (Guru) <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="id_kepalajurusan" 
                                name="id_kepalajurusan" 
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all shadow-2xs appearance-none @error('id_kepalajurusan') border-rose-400 bg-rose-50/30 @enderror">
                            <option value="">-- Pilih Guru Sebagai Kepala Jurusan --</option>
                            @foreach ($guru as $g)
                                <option value="{{ $g->id_guru }}" {{ old('id_kepalajurusan', $jurusan->id_kepalajurusan) == $g->id_guru ? 'selected' : '' }}>
                                    {{ $g->nama }} (NIP: {{ $g->nip ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('id_kepalajurusan')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Form Actions Buttons -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('jurusan.index') }}" 
                   class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-semibold text-xs sm:text-sm text-center transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-purple-500/25 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection