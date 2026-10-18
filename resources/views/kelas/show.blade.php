@extends('layouts.header')
@section('title', 'Manajemen Kelas ' . $kelas->nama_kelas)

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">

    <!-- Class Header Banner -->
    <div class="bg-gradient-to-r from-amber-600 via-orange-600 to-rose-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-orange-900/10 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-start sm:items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center font-extrabold text-2xl shadow-lg shrink-0">
                    {{ substr($kelas->nama_kelas, 0, 3) }}
                </div>
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 text-xs font-semibold text-amber-100 mb-1 border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Rombel Kelas Aktif
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        {{ $kelas->nama_kelas }}
                    </h1>
                    <p class="text-xs sm:text-sm text-amber-100/90 font-medium">
                        Tingkat {{ $kelas->tingkat }} &bull; Tahun Ajaran {{ $kelas->tahun_ajaran }} &bull; Wali: {{ $kelas->guru->nama ?? $kelas->walikelas ?? 'Belum ditentukan' }}
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" 
                   class="px-4 py-2.5 rounded-xl bg-white text-orange-700 hover:bg-orange-50 text-xs sm:text-sm font-bold shadow-md transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Kelas
                </a>
                <a href="{{ route('kelas.index') }}" 
                   class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold border border-white/20 transition-all flex items-center gap-2">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Class Quick Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-6 border-t border-white/15 text-xs">
            <div>
                <span class="text-amber-200 block">Jurusan Kelas:</span>
                <span class="font-bold text-white text-sm">
                    {{ $kelas->jurusan->nama ?? 'Umum (Tanpa Jurusan)' }}
                </span>
                @if($kelas->jurusan && $kelas->jurusan->kode_jurusan)
                    <span class="font-mono bg-white/20 px-1.5 py-0.5 rounded text-[11px] ml-1">[{{ $kelas->jurusan->kode_jurusan }}]</span>
                @endif
            </div>
            <div>
                <span class="text-amber-200 block">Wali Kelas:</span>
                <span class="font-bold text-white text-sm">
                    {{ $kelas->guru->nama ?? $kelas->walikelas ?? '-' }}
                </span>
            </div>
            <div>
                <span class="text-amber-200 block">Jumlah Siswa:</span>
                <span class="font-bold text-white text-sm">
                    {{ $kelas->siswa->count() }} Peserta Didik
                </span>
            </div>
            <div>
                <span class="text-amber-200 block">Siswa Tersedia (Jurusan Sama):</span>
                <span class="font-bold text-white text-sm">
                    {{ $availableSiswa->count() }} Siswa Siap Masuk
                </span>
            </div>
        </div>
    </div>

    <!-- SECTION 1: DAFTAR SISWA DI KELAS INI -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Daftar Siswa Terdaftar di Kelas {{ $kelas->nama_kelas }}
                </h2>
                <p class="text-xs text-slate-500">
                    Menampilkan seluruh siswa yang saat ini aktif terdaftar dalam rombel ini
                </p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 self-start sm:self-auto">
                {{ $kelas->siswa->count() }} Siswa Terdaftar
            </span>
        </div>

        @if($kelas->siswa->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-3.5 px-6 w-14 text-center">No</th>
                            <th class="py-3.5 px-6">Nama Siswa</th>
                            <th class="py-3.5 px-6">Jurusan Siswa</th>
                            <th class="py-3.5 px-6">L/P</th>
                            <th class="py-3.5 px-6">Orang Tua / Kontak</th>
                            <th class="py-3.5 px-6 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($kelas->siswa as $s)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="py-3.5 px-6 text-center font-semibold text-slate-400 text-xs">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="py-3.5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-700 border border-blue-200 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($s->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">
                                                {{ $s->nama }}
                                            </div>
                                            <div class="text-[11px] text-slate-400 font-mono">{{ $s->no_telp ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-6">
                                    @if($s->jurusan)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-purple-50 text-purple-700 border border-purple-200 font-mono">
                                            {{ $s->jurusan->kode_jurusan ?? $s->jurusan->nama }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum diatur</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold {{ in_array(strtoupper($s->jenis_kelamin), ['L', 'LAKI-LAKI']) ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                                        {{ $s->jenis_kelamin }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-xs text-slate-600">
                                    {{ $s->orangtua->nama ?? '-' }}
                                </td>
                                <td class="py-3.5 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Lihat Detail Siswa -->
                                        <a href="{{ route('siswa.show', $s->id_siswa) }}" 
                                           title="Lihat Profil Siswa"
                                           class="p-2 rounded-xl text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white border border-blue-200 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>

                                        <!-- Keluarkan dari Kelas -->
                                        <form action="{{ route('kelas.remove-siswa', [$kelas->id_kelas, $s->id_siswa]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    title="Keluarkan dari Kelas"
                                                    onclick="return confirm('Apakah Anda yakin ingin mengeluarkan {{ $s->nama }} dari kelas {{ $kelas->nama_kelas }}?')"
                                                    class="p-2 rounded-xl text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white border border-rose-200 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 border border-amber-200 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-700">Belum Ada Siswa di Kelas Ini</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto mt-1">
                    Gunakan formulir di bawah untuk menambahkan siswa yang memiliki jurusan sesuai dengan kelas ini.
                </p>
            </div>
        @endif
    </div>

    <!-- SECTION 2: TAMBAH SISWA KE KELAS (SESUAI JURUSAN) -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambahkan Siswa ke Kelas Ini
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Sistem hanya mengizinkan penambahan siswa yang jurusannya sesuai dengan jurusan kelas
                    </p>
                </div>

                <!-- Info Filter Jurusan Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-purple-50 text-purple-800 border border-purple-200 text-xs font-semibold">
                    <svg class="w-4 h-4 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span>Target Jurusan: <strong>{{ $kelas->jurusan->nama ?? 'Semua Jurusan' }}</strong></span>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if($availableSiswa->count() > 0)
                <form action="{{ route('kelas.add-siswa', $kelas->id_kelas) }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Pilih Siswa yang Ingin Dimasukkan:
                        </label>
                        
                        <!-- List Siswa Checkbox / Radio -->
                        <div class="max-h-72 overflow-y-auto border border-slate-200 rounded-2xl divide-y divide-slate-100 bg-slate-50/50 p-1">
                            @foreach ($availableSiswa as $candidate)
                                <label class="flex items-center gap-3.5 p-3 rounded-xl hover:bg-white transition-colors cursor-pointer group">
                                    <input type="checkbox" 
                                           name="id_siswa[]" 
                                           value="{{ $candidate->id_siswa }}"
                                           class="w-4 h-4 text-orange-600 rounded border-slate-300 focus:ring-orange-500">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ strtoupper(substr($candidate->nama, 0, 2)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-bold text-slate-800 group-hover:text-orange-600 transition-colors truncate">
                                            {{ $candidate->nama }}
                                        </div>
                                        <div class="text-xs text-slate-400 flex items-center gap-2">
                                            <span>JK: {{ $candidate->jenis_kelamin }}</span>
                                            <span>&bull;</span>
                                            @if($candidate->kelas)
                                                <span class="text-amber-600 font-medium">(Saat ini di: {{ $candidate->kelas->nama_kelas }})</span>
                                            @else
                                                <span class="text-emerald-600 font-medium">(Belum punya kelas)</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="shrink-0">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold bg-purple-50 text-purple-700 border border-purple-200 font-mono">
                                            {{ $candidate->jurusan->kode_jurusan ?? $candidate->jurusan->nama ?? '-' }}
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
                        <p class="text-xs text-slate-500">
                            Centang satu atau beberapa siswa di atas untuk memasukkannya ke kelas <strong>{{ $kelas->nama_kelas }}</strong>.
                        </p>
                        <button type="submit" 
                                class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-emerald-500/25 transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            Masukkan Siswa Terpilih ke Kelas
                        </button>
                    </div>
                </form>
            @else
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 text-center">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 border border-purple-200 flex items-center justify-center mx-auto mb-2.5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800">Tidak Ada Siswa Tambahan yang Tersedia</h3>
                    <p class="text-xs text-slate-500 max-w-md mx-auto mt-1 mb-4">
                        @if($kelas->id_jurusan)
                            Semua siswa yang mengambil jurusan <strong>{{ $kelas->jurusan->nama ?? '' }}</strong> sudah terdaftar di kelas ini, atau belum ada siswa lain yang didaftarkan pada jurusan ini.
                        @else
                            Semua siswa sudah terdaftar di kelas ini.
                        @endif
                    </p>
                    <a href="{{ route('siswa.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        + Tambah Siswa Baru dengan Jurusan Ini
                    </a>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
