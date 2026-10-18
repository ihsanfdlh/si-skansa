<div class="mx-auto max-w-4xl overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xs">
    <div class="bg-gradient-to-r from-violet-700 via-indigo-700 to-blue-800 p-6 text-white sm:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-violet-100">Rekap Hasil Belajar</span>
                <h1 class="mt-1 text-2xl font-extrabold tracking-tight sm:text-3xl">{{ $formTitle }}</h1>
                <p class="mt-2 text-sm text-violet-100/90">Pilih siswa, mata pelajaran, dan tahun ajaran, lalu masukkan nilai.</p>
            </div>
            <a href="{{ route('nilai.index') }}" class="rounded-xl border border-white/25 bg-white/10 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-white/20">Kembali ke Daftar</a>
        </div>
    </div>

    <form action="{{ isset($nilai) ? route('nilai.update', $nilai) : route('nilai.store') }}" method="POST" class="space-y-6 p-6 sm:p-8">
        @csrf
        @if (isset($nilai))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div class="space-y-1.5 sm:col-span-2">
                <label for="id_siswa" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Siswa <span class="text-rose-500">*</span></label>
                <select id="id_siswa" name="id_siswa" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 @error('id_siswa') border-rose-400 @enderror">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswa as $item)
                        <option value="{{ $item->id_siswa }}" @selected(old('id_siswa', $nilai->id_siswa ?? '') == $item->id_siswa)>{{ $item->nama }}{{ $item->kelas ? ' — '.$item->kelas->nama_kelas : '' }}</option>
                    @endforeach
                </select>
                @error('id_siswa') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                @if ($siswa->isEmpty()) <p class="text-xs text-amber-700">Data siswa belum tersedia.</p> @endif
            </div>

            <div class="space-y-1.5">
                <label for="id_mapel" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Mata Pelajaran <span class="text-rose-500">*</span></label>
                <select id="id_mapel" name="id_mapel" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 @error('id_mapel') border-rose-400 @enderror">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach ($mapel as $item)
                        <option value="{{ $item->id_mapel }}" @selected(old('id_mapel', $nilai->id_mapel ?? '') == $item->id_mapel)>{{ $item->kode_mapel }} — {{ $item->nama_mapel }}</option>
                    @endforeach
                </select>
                @error('id_mapel') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                @if ($mapel->isEmpty()) <p class="text-xs text-amber-700">Data mata pelajaran belum tersedia.</p> @endif
            </div>

            <div class="space-y-1.5">
                <label for="id_tahunajaran" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Tahun Ajaran <span class="text-rose-500">*</span></label>
                <select id="id_tahunajaran" name="id_tahunajaran" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 @error('id_tahunajaran') border-rose-400 @enderror">
                    <option value="">-- Pilih Tahun Ajaran --</option>
                    @foreach ($tahunAjaran as $item)
                        <option value="{{ $item->id_tahunajaran }}" @selected(old('id_tahunajaran', $nilai->id_tahunajaran ?? '') == $item->id_tahunajaran)>{{ $item->tahun_ajaran }} — {{ $item->semester }}{{ $item->status === 'Aktif' ? ' (Aktif)' : '' }}</option>
                    @endforeach
                </select>
                @error('id_tahunajaran') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                @if ($tahunAjaran->isEmpty()) <p class="text-xs text-amber-700">Data tahun ajaran belum tersedia.</p> @endif
            </div>

            <div class="space-y-1.5">
                <label for="nilai_pengetahuan" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nilai Pengetahuan <span class="text-rose-500">*</span></label>
                <input id="nilai_pengetahuan" name="nilai_pengetahuan" type="number" min="0" max="100" step="0.01" required value="{{ old('nilai_pengetahuan', $nilai->nilai_pengetahuan ?? '') }}" placeholder="0–100" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 @error('nilai_pengetahuan') border-rose-400 @enderror">
                @error('nilai_pengetahuan') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label for="nilai_keterampilan" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nilai Keterampilan <span class="text-rose-500">*</span></label>
                <input id="nilai_keterampilan" name="nilai_keterampilan" type="number" min="0" max="100" step="0.01" required value="{{ old('nilai_keterampilan', $nilai->nilai_keterampilan ?? '') }}" placeholder="0–100" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 @error('nilai_keterampilan') border-rose-400 @enderror">
                @error('nilai_keterampilan') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label for="nilai_akhir" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nilai Akhir <span class="text-rose-500">*</span></label>
                <input id="nilai_akhir" name="nilai_akhir" type="number" min="0" max="100" step="0.01" required value="{{ old('nilai_akhir', $nilai->nilai_akhir ?? '') }}" placeholder="0–100" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 @error('nilai_akhir') border-rose-400 @enderror">
                @error('nilai_akhir') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label for="predikat" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Predikat</label>
                <input id="predikat" name="predikat" type="text" maxlength="5" value="{{ old('predikat', $nilai->predikat ?? '') }}" placeholder="Contoh: A" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 @error('predikat') border-rose-400 @enderror">
                @error('predikat') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <p class="rounded-xl border border-indigo-100 bg-indigo-50 px-4 py-3 text-xs leading-relaxed text-indigo-800">Rentang nilai adalah 0 sampai 100. Nilai akhir dan predikat diisi sesuai ketentuan penilaian sekolah.</p>

        <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
            <a href="{{ route('nilai.index') }}" class="rounded-xl border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
            <button type="submit" class="rounded-xl bg-indigo-700 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-700/20 transition hover:bg-indigo-800">{{ isset($nilai) ? 'Simpan Perubahan' : 'Simpan Nilai' }}</button>
        </div>
    </form>
</div>
