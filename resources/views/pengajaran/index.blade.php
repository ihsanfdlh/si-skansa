@extends('layouts.header')
@section('title', 'Pengaturan Pengajaran')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-cyan-700 via-blue-700 to-indigo-800 p-6 text-white shadow-xl shadow-blue-900/10 sm:p-8">
        <div class="absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
        <div class="relative z-10 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-2">
                <span class="inline-flex rounded-full border border-white/20 bg-white/15 px-3 py-1 text-xs font-semibold text-cyan-100">Jadwal Kegiatan Belajar Mengajar</span>
                <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl">Pengaturan Pengajaran</h1>
                <p class="max-w-xl text-sm text-cyan-100/90">Atur penugasan guru, mata pelajaran, kelas, hari, dan jam mengajar.</p>
            </div>
            <a href="{{ route('pengajaran.create') }}" class="inline-flex items-center justify-center gap-2 self-start rounded-xl bg-white px-5 py-3 text-sm font-bold text-blue-700 shadow-lg transition hover:bg-blue-50 sm:self-auto">
                <span class="text-lg leading-none">+</span> Tambah Jadwal
            </a>
        </div>
        <div class="relative z-10 mt-6 border-t border-white/15 pt-5 text-sm text-cyan-100">
            Total jadwal terdaftar: <strong class="text-white">{{ $pengajaran->count() }}</strong>
        </div>
    </div>

    @if (session('success'))
        <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xs">
        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
            <h2 class="font-bold text-slate-800">Daftar Jadwal Mengajar</h2>
            <p class="mt-1 text-xs text-slate-500">Jadwal berdasarkan hari dan jam pembelajaran.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] border-collapse text-left">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="px-5 py-3.5 text-center">No</th>
                        <th class="px-5 py-3.5">Guru</th>
                        <th class="px-5 py-3.5">Mata Pelajaran</th>
                        <th class="px-5 py-3.5">Kelas</th>
                        <th class="px-5 py-3.5">Hari</th>
                        <th class="px-5 py-3.5">Jam</th>
                        <th class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($pengajaran as $jadwal)
                        <tr class="transition hover:bg-slate-50/80">
                            <td class="px-5 py-4 text-center text-xs font-semibold text-slate-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 font-semibold text-slate-800">{{ $jadwal->guru->nama }}</td>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-800">{{ $jadwal->mapel->nama_mapel }}</div>
                                <div class="text-xs text-slate-500">{{ $jadwal->mapel->kode_mapel }}</div>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                            <td class="px-5 py-4">
                                <span class="rounded-full bg-cyan-50 px-2.5 py-1 text-xs font-semibold text-cyan-700">{{ $jadwal->hari }}</span>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $jadwal->jam }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('pengajaran.edit', $jadwal) }}" class="rounded-lg border border-blue-200 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-50">Edit</a>
                                    <form action="{{ route('pengajaran.destroy', $jadwal) }}" method="POST" onsubmit="return confirm('Hapus jadwal pengajaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 transition hover:bg-rose-50">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <p class="font-semibold text-slate-700">Belum ada jadwal pengajaran.</p>
                                <p class="mt-1 text-sm text-slate-500">Tambahkan jadwal untuk mulai mengatur kegiatan belajar mengajar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
