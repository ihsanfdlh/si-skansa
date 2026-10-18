<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NilaiController extends Controller
{
    public function index(): View
    {
        $nilai = Nilai::with(['siswa.kelas', 'mapel', 'tahunAjaran'])
            ->latest('id_nilai')
            ->get();

        return view('nilai.index', compact('nilai'));
    }

    public function create(): View
    {
        return view('nilai.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        Nilai::create($validated);

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai siswa berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai): View
    {
        return view('nilai.edit', [
            ...$this->formOptions(),
            'nilai' => $nilai,
        ]);
    }

    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        $validated = $this->validatedData($request, $nilai);
        $nilai->update($validated);

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai siswa berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai siswa berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Nilai $nilai = null): array
    {
        return $request->validate([
            'id_siswa' => [
                'required',
                'exists:siswas,id_siswa',
                Rule::unique('nilais', 'id_siswa')
                    ->where(fn (Builder $query) => $query
                        ->where('id_mapel', $request->input('id_mapel'))
                        ->where('id_tahunajaran', $request->input('id_tahunajaran')))
                    ->ignore($nilai?->id_nilai, 'id_nilai'),
            ],
            'id_mapel' => ['required', 'exists:mata_pelajarans,id_mapel'],
            'id_tahunajaran' => ['required', 'exists:tahun_ajarans,id_tahunajaran'],
            'nilai_pengetahuan' => ['required', 'numeric', 'between:0,100'],
            'nilai_keterampilan' => ['required', 'numeric', 'between:0,100'],
            'nilai_akhir' => ['required', 'numeric', 'between:0,100'],
            'predikat' => ['nullable', 'string', 'max:5'],
        ], [
            'id_siswa.unique' => 'Nilai untuk siswa, mata pelajaran, dan tahun ajaran ini sudah tersedia.',
            'nilai_pengetahuan.between' => 'Nilai pengetahuan harus antara 0 sampai 100.',
            'nilai_keterampilan.between' => 'Nilai keterampilan harus antara 0 sampai 100.',
            'nilai_akhir.between' => 'Nilai akhir harus antara 0 sampai 100.',
        ]);
    }

    private function formOptions(): array
    {
        return [
            'siswa' => Siswa::with('kelas')->orderBy('nama')->get(),
            'mapel' => MataPelajaran::orderBy('nama_mapel')->get(),
            'tahunAjaran' => TahunAjaran::orderByDesc('tahun_ajaran')
                ->orderBy('semester')
                ->get(),
        ];
    }
}
