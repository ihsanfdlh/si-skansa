<div class="mx-auto max-w-4xl overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xs">
    <div class="bg-gradient-to-r from-cyan-700 via-blue-700 to-indigo-800 p-6 text-white sm:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-cyan-100">Jadwal Pembelajaran</span>
                <h1 class="mt-1 text-2xl font-extrabold tracking-tight sm:text-3xl">{{ $formTitle }}</h1>
                <p class="mt-2 text-sm text-cyan-100/90">Lengkapi informasi penugasan dan waktu mengajar.</p>
            </div>
            <a href="{{ route('pengajaran.index') }}" class="rounded-xl border border-white/25 bg-white/10 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-white/20">Kembali ke Daftar</a>
        </div>
    </div>

    <form action="{{ isset($pengajaran) ? route('pengajaran.update', $pengajaran) : route('pengajaran.store') }}" method="POST" class="space-y-6 p-6 sm:p-8">
        @csrf
        @if (isset($pengajaran))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div class="space-y-1.5">
                <label for="id_guru" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Guru <span class="text-rose-500">*</span></label>
                <select id="id_guru" name="id_guru" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 @error('id_guru') border-rose-400 @enderror">
                    <option value="">-- Pilih Guru --</option>
                    @foreach ($guru as $item)
                        <option value="{{ $item->id_guru }}" @selected(old('id_guru', $pengajaran->id_guru ?? '') == $item->id_guru)>{{ $item->nama }}{{ $item->nip ? ' - '.$item->nip : '' }}</option>
                    @endforeach
                </select>
                @error('id_guru') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                @if ($guru->isEmpty()) <p class="text-xs text-amber-700">Data guru belum tersedia.</p> @endif
            </div>

            <div class="space-y-1.5">
                <label for="id_mapel" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Mata Pelajaran <span class="text-rose-500">*</span></label>
                <select id="id_mapel" name="id_mapel" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 @error('id_mapel') border-rose-400 @enderror">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach ($mapel as $item)
                        <option value="{{ $item->id_mapel }}" @selected(old('id_mapel', $pengajaran->id_mapel ?? '') == $item->id_mapel)>{{ $item->kode_mapel }} — {{ $item->nama_mapel }}{{ $item->jurusan ? ' ('.$item->jurusan->nama.')' : '' }}</option>
                    @endforeach
                </select>
                @error('id_mapel') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                @if ($mapel->isEmpty()) <p class="text-xs text-amber-700">Data mata pelajaran belum tersedia.</p> @endif
            </div>

            <div class="space-y-1.5">
                <label for="id_kelas" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Kelas <span class="text-rose-500">*</span></label>
                <select id="id_kelas" name="id_kelas" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 @error('id_kelas') border-rose-400 @enderror">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->id_kelas }}" @selected(old('id_kelas', $pengajaran->id_kelas ?? '') == $item->id_kelas)>{{ $item->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('id_kelas') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                @if ($kelas->isEmpty()) <p class="text-xs text-amber-700">Data kelas belum tersedia.</p> @endif
            </div>

            <div class="space-y-1.5">
                <label for="hari" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Hari <span class="text-rose-500">*</span></label>
                <select id="hari" name="hari" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 @error('hari') border-rose-400 @enderror">
                    <option value="">-- Pilih Hari --</option>
                    @foreach ($hari as $item)
                        <option value="{{ $item }}" @selected(old('hari', $pengajaran->hari ?? '') === $item)>{{ $item }}</option>
                    @endforeach
                </select>
                @error('hari') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5 sm:col-span-2">
                <label for="jam" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Jam Pelajaran <span class="text-rose-500">*</span></label>
                <input id="jam" name="jam" type="text" maxlength="30" required value="{{ old('jam', $pengajaran->jam ?? '') }}" placeholder="Contoh: 07:00 - 08:30" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-blue-500/20 @error('jam') border-rose-400 @enderror">
                @error('jam') <p class="text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
            <a href="{{ route('pengajaran.index') }}" class="rounded-xl border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
            <button type="submit" class="rounded-xl bg-blue-700 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-700/20 transition hover:bg-blue-800">{{ isset($pengajaran) ? 'Simpan Perubahan' : 'Simpan Jadwal' }}</button>
        </div>
    </form>
</div>
