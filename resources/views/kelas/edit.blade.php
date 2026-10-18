@extends('layouts.header')
@section('title', 'Edit Data Kelas')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Card Form Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Header Banner Form -->
        <div class="bg-gradient-to-r from-amber-600 via-orange-600 to-rose-700 p-6 sm:p-8 text-white relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-amber-100 border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        Perbarui Rombel
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        Edit Data Kelas: {{ $kelas->nama_kelas }}
                    </h1>
                    <p class="text-xs sm:text-sm text-amber-100/90">
                        Perbarui informasi rombongan belajar, wali kelas, atau tingkat kelas.
                    </p>
                </div>

                <a href="{{ route('kelas.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold backdrop-blur-md border border-white/20 transition-all self-start sm:self-auto shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Daftar</span>
                </a>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Kelas -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="nama_kelas" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Nama Kelas <span class="text-rose-500">*</span>
                    </label>
                    <input id="nama_kelas" 
                           type="text" 
                           name="nama_kelas" 
                           value="{{ old('nama_kelas', $kelas->nama_kelas) }}" 
                           placeholder="Contoh: XII RPL 1 / XI TKJ 2" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all shadow-2xs @error('nama_kelas') border-rose-400 bg-rose-50/30 @enderror">
                    @error('nama_kelas')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tingkat -->
                <div class="space-y-1.5">
                    <label for="tingkat" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Tingkat / Jenjang <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="tingkat" 
                                name="tingkat" 
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all shadow-2xs appearance-none @error('tingkat') border-rose-400 bg-rose-50/30 @enderror">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="10" {{ old('tingkat', $kelas->tingkat) == '10' ? 'selected' : '' }}>Tingkat X (Kelas 10)</option>
                            <option value="11" {{ old('tingkat', $kelas->tingkat) == '11' ? 'selected' : '' }}>Tingkat XI (Kelas 11)</option>
                            <option value="12" {{ old('tingkat', $kelas->tingkat) == '12' ? 'selected' : '' }}>Tingkat XII (Kelas 12)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('tingkat')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun Ajaran -->
                <div class="space-y-1.5">
                    <label for="tahun_ajaran" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Tahun Ajaran <span class="text-rose-500">*</span>
                    </label>
                    <input id="tahun_ajaran" 
                           type="text" 
                           name="tahun_ajaran" 
                           value="{{ old('tahun_ajaran', $kelas->tahun_ajaran) }}" 
                           placeholder="Contoh: 2026/2027" 
                           required
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all shadow-2xs @error('tahun_ajaran') border-rose-400 bg-rose-50/30 @enderror">
                    @error('tahun_ajaran')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilihan Jurusan -->
                <div class="space-y-1.5">
                    <label for="id_jurusan" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Jurusan / Program Keahlian
                    </label>
                    @if(isset($jurusan) && count($jurusan) > 0)
                        <div class="relative">
                            <select id="id_jurusan" 
                                    name="id_jurusan" 
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all shadow-2xs appearance-none">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan', $kelas->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                                        {{ $j->kode_jurusan ? '[' . $j->kode_jurusan . '] ' : '' }}{{ $j->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    @else
                        <input id="id_jurusan" 
                               type="text" 
                               name="id_jurusan" 
                               value="{{ old('id_jurusan', $kelas->id_jurusan) }}" 
                               placeholder="Nama atau ID Jurusan" 
                               class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all shadow-2xs">
                    @endif
                </div>

                <!-- Walikelas -->
                <div class="space-y-1.5">
                    <label for="id_walikelas" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Wali Kelas (Dewan Guru) <span class="text-rose-500">*</span>
                    </label>
                    @if(isset($guru) && count($guru) > 0)
                        <div class="relative">
                            <select id="id_walikelas" 
                                    name="id_walikelas" 
                                    required
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all shadow-2xs appearance-none @error('id_walikelas') border-rose-400 bg-rose-50/30 @enderror">
                                <option value="">-- Pilih Guru Sebagai Wali Kelas --</option>
                                @foreach ($guru as $g)
                                    <option value="{{ $g->id_guru }}" {{ old('id_walikelas', $kelas->id_walikelas) == $g->id_guru ? 'selected' : '' }}>
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
                    @else
                        <input id="id_walikelas" 
                               type="text" 
                               name="id_walikelas" 
                               value="{{ old('id_walikelas', $kelas->id_walikelas) }}" 
                               placeholder="ID Guru Wali Kelas" 
                               required
                               class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all shadow-2xs">
                    @endif
                    @error('id_walikelas')
                        <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Form Actions Buttons -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('kelas.index') }}" 
                   class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-semibold text-xs sm:text-sm text-center transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-orange-500/25 transition-all flex items-center justify-center gap-2">
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