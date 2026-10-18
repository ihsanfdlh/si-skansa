@extends('layouts.header')
@section('title', 'Data Orang Tua')

@section('content')
<div class="space-y-6">

    <!-- Top Header Banner & Actions -->
    <div class="bg-gradient-to-r from-rose-600 via-pink-600 to-indigo-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-rose-900/10 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-rose-100 border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    Wali & Orang Tua Murid
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                    Data Orang Tua & Wali
                </h1>
                <p class="text-sm text-rose-100/90 max-w-xl">
                    Informasi kontak dan data identitas orang tua/wali siswa SMK Negeri 1 (SKANSA).
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('orangtua.create') }}" class="px-5 py-2.5 rounded-xl bg-white text-rose-700 hover:bg-rose-50 font-bold text-xs sm:text-sm shadow-lg shadow-black/10 transition-all flex items-center gap-2 group">
                    <svg class="w-4 h-4 text-rose-600 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Orang Tua
                </a>
            </div>
        </div>

        <!-- Quick Mini Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-6 pt-6 border-t border-white/15">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-rose-200">Total Orang Tua</div>
                    <div class="text-lg font-bold text-white">{{ $orangtua->count() }} Orang</div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-rose-200">Kontak Tersedia</div>
                    <div class="text-lg font-bold text-white">{{ $orangtua->whereNotNull('no_telp')->count() }} Nomor</div>
                </div>
            </div>
            <div class="col-span-2 sm:col-span-1 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-rose-200">Status Sinkronisasi</div>
                    <div class="text-lg font-bold text-emerald-300">Terverifikasi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Table Toolbar -->
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-800">Daftar Orang Tua / Wali</h2>
                <p class="text-xs text-slate-500">Database identitas wali murid SMK Negeri 1 (SKANSA)</p>
            </div>
            
            <div class="relative w-full sm:w-64">
                <input type="text" 
                       id="searchOrtuInput"
                       placeholder="Cari nama orang tua..." 
                       class="w-full pl-9 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-700 placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Table Responsive Wrapper -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="ortuTable">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6 w-14 text-center">No</th>
                        <th class="py-3.5 px-6">Nama Lengkap</th>
                        <th class="py-3.5 px-6">Tempat & Tanggal Lahir</th>
                        <th class="py-3.5 px-6">No. Telepon / WhatsApp</th>
                        <th class="py-3.5 px-6 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($orangtua as $ort)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="py-4 px-6 text-center font-semibold text-slate-400 text-xs">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-700 border border-rose-200 flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($ort->nama, 0, 2)) }}
                                    </div>
                                    <span class="font-bold text-slate-800 group-hover:text-rose-600 transition-colors">
                                        {{ $ort->nama }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600 text-xs">
                                <span class="font-medium text-slate-700">{{ $ort->tempat_lahir }}</span>, 
                                <span class="text-slate-400">{{ $ort->tanggal_lahir }}</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600 font-mono">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12c0 1.82.49 3.53 1.34 5L2 22l5.18-1.31A9.957 9.957 0 0012 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm.05 16.5c-1.57 0-3.04-.43-4.31-1.18l-.31-.18-3.14.79.84-3.02-.2-.33A7.957 7.957 0 014 12c0-4.41 3.59-8 8-8s8 3.59 8 8-3.59 8-7.95 8.5z"/>
                                    </svg>
                                    <span>{{ $ort->no_telp ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('orangtua.edit', $ort->id_orangtua) }}" 
                                       title="Edit Data Orang Tua"
                                       class="p-2 rounded-xl text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white border border-blue-200 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <!-- Tombol Lihat -->
                                    <a href="{{ route('orangtua.show', $ort->id_orangtua) }}" 
                                       title="Lihat Detail"
                                       class="p-2 rounded-xl text-emerald-600 bg-emerald-50 hover:bg-emerald-600 hover:text-white border border-emerald-200 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('orangtua.destroy', $ort->id_orangtua) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Hapus Data"
                                                onclick="return confirm('Yakin ingin menghapus data {{ $ort->nama }}?')"
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
                            <td colspan="5" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">Data Orang Tua Masih Kosong</h3>
                                    <p class="text-xs text-slate-500 mb-4">Belum ada data orang tua atau wali murid yang tersimpan.</p>
                                    <a href="{{ route('orangtua.create') }}" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-colors">
                                        + Tambah Orang Tua Baru
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
                Menampilkan <strong>{{ $orangtua->count() }}</strong> orang tua/wali murid
            </div>
            <div class="text-slate-400">
                SMK Negeri 1 (SKANSA)
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchOrtuInput')?.addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('#ortuTable tbody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection