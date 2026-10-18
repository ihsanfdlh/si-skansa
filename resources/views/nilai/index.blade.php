@extends('layouts.header')
@section('title', 'Pengaturan Nilai')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-violet-700 via-indigo-700 to-blue-800 p-6 text-white shadow-xl shadow-indigo-900/10 sm:p-8">
        <div class="absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
        <div class="relative z-10 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-2">
                <span class="inline-flex rounded-full border border-white/20 bg-white/15 px-3 py-1 text-xs font-semibold text-violet-100">Rekap Hasil Belajar</span>
                <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl">Pengaturan Nilai Siswa</h1>
                <p class="max-w-xl text-sm text-violet-100/90">Kelola nilai pengetahuan, keterampilan, nilai akhir, dan predikat berdasarkan tahun ajaran.</p>
            </div>
            <a href="{{ route('nilai.create') }}" class="inline-flex items-center justify-center gap-2 self-start rounded-xl bg-white px-5 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:bg-indigo-50 sm:self-auto">
                <span class="text-lg leading-none">+</span> Tambah Nilai
            </a>
        </div>
        <div class="relative z-10 mt-6 border-t border-white/15 pt-5 text-sm text-violet-100">
            Total catatan nilai: <strong class="text-white">{{ $nilai->count() }}</strong>
        </div>
    </div>

    @if (session('success'))
        <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xs">
        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
            <h2 class="font-bold text-slate-800">Daftar Nilai</h2>
            <p class="mt-1 text-xs text-slate-500">Nilai dikelompokkan berdasarkan siswa, mata pelajaran, dan tahun ajaran.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[980px] border-collapse text-left">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="px-5 py-3.5 text-center">No</th>
                        <th class="px-5 py-3.5">Siswa</th>
                        <th class="px-5 py-3.5">Mata Pelajaran</th>
                        <th class="px-5 py-3.5">Tahun Ajaran</th>
                        <th class="px-5 py-3.5 text-right">Pengetahuan</th>
                        <th class="px-5 py-3.5 text-right">Keterampilan</th>
                        <th class="px-5 py-3.5 text-right">Nilai Akhir</th>
                        <th class="px-5 py-3.5 text-center">Predikat</th>
                        <th class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($nilai as $item)
                        <tr class="transition hover:bg-slate-50/80">
                            <td class="px-5 py-4 text-center text-xs font-semibold text-slate-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-800">{{ $item->siswa->nama }}</div>
                                <div class="text-xs text-slate-500">{{ $item->siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-800">{{ $item->mapel->nama_mapel }}</div>
                                <div class="text-xs text-slate-500">{{ $item->mapel->kode_mapel }}</div>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $item->tahunAjaran->tahun_ajaran }} · {{ $item->tahunAjaran->semester }}</td>
                            <td class="px-5 py-4 text-right tabular-nums text-slate-600">{{ number_format((float) $item->nilai_pengetahuan, 2, ',', '.') }}</td>
                            <td class="px-5 py-4 text-right tabular-nums text-slate-600">{{ number_format((float) $item->nilai_keterampilan, 2, ',', '.') }}</td>
                            <td class="px-5 py-4 text-right font-bold tabular-nums text-indigo-700">{{ number_format((float) $item->nilai_akhir, 2, ',', '.') }}</td>
                            <td class="px-5 py-4 text-center">
                                <span class="rounded-full bg-violet-50 px-2.5 py-1 text-xs font-bold text-violet-700">{{ $item->predikat ?: '-' }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('nilai.edit', $item) }}" class="rounded-lg border border-blue-200 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-50">Edit</a>
                                    <form action="{{ route('nilai.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus catatan nilai ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 transition hover:bg-rose-50">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-5 py-12 text-center">
                                <p class="font-semibold text-slate-700">Belum ada nilai siswa.</p>
                                <p class="mt-1 text-sm text-slate-500">Tambahkan nilai untuk mulai membuat rekap hasil belajar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
