@extends('layouts.header')
@section('title', 'Data Siswa')

@section('content')
<div class="space-y-6">

    <!-- Top Header Banner & Actions -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-blue-900/10 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-blue-100 border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Peserta Didik SKANSA
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                    Data Siswa & Siswi
                </h1>
                <p class="text-sm text-blue-100/90 max-w-xl">
                    Informasi lengkap peserta didik SMK Negeri 1 (SKANSA) beserta data orang tua/wali dan kontak.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('siswa.create') }}" class="px-5 py-2.5 rounded-xl bg-white text-blue-700 hover:bg-blue-50 font-bold text-xs sm:text-sm shadow-lg shadow-black/10 transition-all flex items-center gap-2 group">
                    <svg class="w-4 h-4 text-blue-600 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Siswa
                </a>
            </div>
        </div>

        <!-- Quick Mini Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-6 pt-6 border-t border-white/15">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-blue-200">Total Siswa</div>
                    <div class="text-lg font-bold text-white">{{ $siswa->count() }} Orang</div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-blue-200">Terhubung Orang Tua</div>
                    <div class="text-lg font-bold text-white">{{ $siswa->whereNotNull('orangtua')->count() }} Data</div>
                </div>
            </div>
            <div class="col-span-2 sm:col-span-1 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-blue-200">Status Siswa</div>
                    <div class="text-lg font-bold text-emerald-300">Aktif Belajar</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Table Toolbar -->
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-800">Daftar Induk Siswa</h2>
                <p class="text-xs text-slate-500">Database identitas siswa aktif SMK Negeri 1 (SKANSA)</p>
            </div>
            
            <div class="relative w-full sm:w-64">
                <input type="text" 
                       id="searchSiswaInput"
                       placeholder="Cari nama siswa / wali..." 
                       class="w-full pl-9 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-700 placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Table Responsive Wrapper -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="siswaTable">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6 w-14 text-center">No</th>
                        <th class="py-3.5 px-6">Nama Siswa</th>
                        <th class="py-3.5 px-6">Jurusan</th>
                        <th class="py-3.5 px-6">Kelas</th>
                        <th class="py-3.5 px-6">L/P</th>
                        <th class="py-3.5 px-6">Orang Tua</th>
                        <th class="py-3.5 px-6">No. Telepon</th>
                        <th class="py-3.5 px-6 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($siswa as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="py-4 px-6 text-center font-semibold text-slate-400 text-xs">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 border border-blue-200 flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($item->nama, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">
                                            {{ $item->nama }}
                                        </div>
                                        <div class="text-xs text-slate-400 truncate max-w-xs">{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($item->jurusan)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-purple-50 text-purple-700 border border-purple-200 font-mono" title="{{ $item->jurusan->nama }}">
                                        {{ $item->jurusan->kode_jurusan ?? substr($item->jurusan->nama, 0, 6) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium text-slate-400 bg-slate-100">
                                        Belum Diatur
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($item->kelas)
                                    <a href="{{ route('kelas.show', $item->kelas->id_kelas) }}" class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200 transition-colors">
                                        {{ $item->kelas->nama_kelas }}
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400 italic">Belum Ada Kelas</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold {{ in_array(strtoupper($item->jenis_kelamin), ['L', 'LAKI-LAKI']) ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                                    {{ $item->jenis_kelamin }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-700 font-medium text-xs">
                                        {{ $item->orangtua->nama ?? '-' }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600 font-mono">
                                {{ $item->no_telp ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('siswa.edit', $item->id_siswa) }}" 
                                       title="Edit Data Siswa"
                                       class="p-2 rounded-xl text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white border border-blue-200 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <!-- Tombol Lihat -->
                                    <a href="{{ route('siswa.show', $item->id_siswa) }}" 
                                       title="Lihat Detail"
                                       class="p-2 rounded-xl text-emerald-600 bg-emerald-50 hover:bg-emerald-600 hover:text-white border border-emerald-200 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Hapus Siswa"
                                                onclick="return confirm('Yakin ingin menghapus data siswa {{ $item->nama }}?')"
                                                class="p-2 rounded-xl text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white border border-rose-200 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">Data Siswa Masih Kosong</h3>
                                    <p class="text-xs text-slate-500 mb-4">Tambahkan data siswa pertama untuk memulai pengelolaan.</p>
                                    <a href="{{ route('siswa.create') }}" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-colors">
                                        + Tambah Siswa Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="py-4 px-6 bg-slate-50/60 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <div>
                Menampilkan <strong>{{ $siswa->count() }}</strong> peserta didik
            </div>
            <div class="text-slate-400">
                SMK Negeri 1 (SKANSA)
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchSiswaInput')?.addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('#siswaTable tbody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection