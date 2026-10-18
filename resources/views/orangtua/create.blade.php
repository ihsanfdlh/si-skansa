@extends('layouts.header')
@section('title', 'Tambah Data Orang Tua')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Card Form Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Header Banner Form -->
        <div class="bg-gradient-to-r from-rose-600 via-pink-600 to-indigo-700 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-rose-100 border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Wali Murid Baru
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        Tambah Data Orang Tua / Wali
                    </h1>
                    <p class="text-xs sm:text-sm text-rose-100/90">
                        Lengkapi identitas orang tua atau wali siswa untuk keperluan kontak sekolah.
                    </p>
                </div>

                <a href="{{ route('orangtua.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold backdrop-blur-md border border-white/20 transition-all self-start sm:self-auto shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Daftar</span>
                </a>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('orangtua.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Lengkap -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Nama Lengkap Orang Tua / Wali <span class="text-rose-500">*</span>
                    </label>
                    <input id="nama" 
                           type="text" 
                           name="nama" 
                           value="{{ old('nama') }}" 
                           placeholder="Contoh: Hendra Wijaya" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all shadow-2xs @error('nama') border-rose-400 bg-rose-50/30 @enderror">
                    @error('nama')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tempat Lahir -->
                <div class="space-y-1.5">
                    <label for="tempat_lahir" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Tempat Lahir <span class="text-rose-500">*</span>
                    </label>
                    <input id="tempat_lahir" 
                           type="text" 
                           name="tempat_lahir" 
                           value="{{ old('tempat_lahir') }}" 
                           placeholder="Contoh: Bandung" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all shadow-2xs @error('tempat_lahir') border-rose-400 bg-rose-50/30 @enderror">
                    @error('tempat_lahir')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div class="space-y-1.5">
                    <label for="tanggal_lahir" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Tanggal Lahir <span class="text-rose-500">*</span>
                    </label>
                    <input id="tanggal_lahir" 
                           type="text" 
                           name="tanggal_lahir" 
                           value="{{ old('tanggal_lahir') }}" 
                           placeholder="Contoh: 18 Agustus 1978" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all shadow-2xs @error('tanggal_lahir') border-rose-400 bg-rose-50/30 @enderror">
                    @error('tanggal_lahir')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No Telp -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="no_telp" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        No. Telepon / WhatsApp
                    </label>
                    <input id="no_telp" 
                           type="text" 
                           name="no_telp" 
                           value="{{ old('no_telp') }}" 
                           placeholder="Contoh: 081398765432" 
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all shadow-2xs">
                </div>

            </div>

            <!-- Form Actions Buttons -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('orangtua.index') }}" 
                   class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-semibold text-xs sm:text-sm text-center transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-rose-500/25 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Data Orang Tua
                </button>
            </div>
        </form>

    </div>
</div>
@endsection