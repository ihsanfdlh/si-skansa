@extends('layouts.header')
@section('title', 'Edit Data Siswa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Card Form Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Header Banner Form -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-700 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-blue-100 border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        Perbarui Data Siswa
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        Edit Data Siswa: {{ $siswa->nama }}
                    </h1>
                    <p class="text-xs sm:text-sm text-blue-100/90">
                        Perbarui data diri siswa atau data orang tua/wali murid yang bersangkutan.
                    </p>
                </div>

                <a href="{{ route('siswa.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold backdrop-blur-md border border-white/20 transition-all self-start sm:self-auto shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Daftar</span>
                </a>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Lengkap -->
                <div class="md:col-span-2 space-y-1.5">
                    <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Nama Lengkap Siswa <span class="text-rose-500">*</span>
                    </label>
                    <input id="nama" 
                           type="text" 
                           name="nama" 
                           value="{{ old('nama', $siswa->nama) }}" 
                           placeholder="Contoh: Muhammad Ihsan Fadilah" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs @error('nama') border-rose-400 bg-rose-50/30 @enderror">
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
                           value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" 
                           placeholder="Contoh: Jakarta" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs @error('tempat_lahir') border-rose-400 bg-rose-50/30 @enderror">
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
                           value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" 
                           placeholder="Contoh: 15 Mei 2008" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs @error('tanggal_lahir') border-rose-400 bg-rose-50/30 @enderror">
                    @error('tanggal_lahir')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div class="space-y-1.5">
                    <label for="jenis_kelamin" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Jenis Kelamin <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="jenis_kelamin" 
                                name="jenis_kelamin" 
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs appearance-none @error('jenis_kelamin') border-rose-400 bg-rose-50/30 @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('jenis_kelamin')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Agama -->
                <div class="space-y-1.5">
                    <label for="agama" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Agama <span class="text-rose-500">*</span>
                    </label>
                    <input id="agama" 
                           type="text" 
                           name="agama" 
                           value="{{ old('agama', $siswa->agama) }}" 
                           placeholder="Contoh: Islam / Kristen / Hindu" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs @error('agama') border-rose-400 bg-rose-50/30 @enderror">
                    @error('agama')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No Telepon -->
                <div class="space-y-1.5">
                    <label for="no_telp" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        No. Telepon / WhatsApp
                    </label>
                    <input id="no_telp" 
                           type="text" 
                           name="no_telp" 
                           value="{{ old('no_telp', $siswa->no_telp) }}" 
                           placeholder="Contoh: 081234567890" 
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs">
                </div>

                <!-- Pilihan Orang Tua -->
                <div class="space-y-1.5">
                    <label for="id_orangtua" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Orang Tua / Wali Murid <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="id_orangtua" 
                                name="id_orangtua" 
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs appearance-none @error('id_orangtua') border-rose-400 bg-rose-50/30 @enderror">
                            <option value="">-- Pilih Orang Tua / Wali --</option>
                            @foreach ($orangtua as $ort)
                                <option value="{{ $ort->id_orangtua }}" {{ old('id_orangtua', $siswa->id_orangtua) == $ort->id_orangtua ? 'selected' : '' }}>
                                    {{ $ort->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('id_orangtua')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat Lengkap -->
                <div class="md:col-span-2 space-y-1.5">
                    <label for="alamat" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Alamat Tempat Tinggal <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="alamat" 
                              name="alamat" 
                              rows="3" 
                              placeholder="Masukkan alamat lengkap tempat tinggal siswa saat ini..." 
                              required
                              class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-2xs @error('alamat') border-rose-400 bg-rose-50/30 @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Form Actions Buttons -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('siswa.index') }}" 
                   class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-semibold text-xs sm:text-sm text-center transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-blue-500/25 transition-all flex items-center justify-center gap-2">
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