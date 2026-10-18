<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengajaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengajaranController extends Controller
{
    private const HARI = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    public function index(): View
    {
        $pengajaran = Pengajaran::with(['guru', 'mapel', 'kelas'])
            ->orderByRaw("CASE hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 ELSE 7 END")
            ->orderBy('jam')
            ->get();

        return view('pengajaran.index', compact('pengajaran'));
    }

    public function create(): View
    {
        return view('pengajaran.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_guru' => ['required', 'exists:gurus,id_guru'],
            'id_mapel' => ['required', 'exists:mata_pelajarans,id_mapel'],
            'id_kelas' => ['required', 'exists:kelas,id_kelas'],
            'hari' => ['required', 'in:'.implode(',', self::HARI)],
            'jam' => ['required', 'string', 'max:30'],
        ]);

        Pengajaran::create($validated);

        return redirect()->route('pengajaran.index')
            ->with('success', 'Jadwal pengajaran berhasil ditambahkan.');
    }

    public function edit(Pengajaran $pengajaran): View
    {
        return view('pengajaran.edit', [
            ...$this->formOptions(),
            'pengajaran' => $pengajaran,
        ]);
    }

    public function update(Request $request, Pengajaran $pengajaran): RedirectResponse
    {
        $validated = $request->validate([
            'id_guru' => ['required', 'exists:gurus,id_guru'],
            'id_mapel' => ['required', 'exists:mata_pelajarans,id_mapel'],
            'id_kelas' => ['required', 'exists:kelas,id_kelas'],
            'hari' => ['required', 'in:'.implode(',', self::HARI)],
            'jam' => ['required', 'string', 'max:30'],
        ]);

        $pengajaran->update($validated);

        return redirect()->route('pengajaran.index')
            ->with('success', 'Jadwal pengajaran berhasil diperbarui.');
    }

    public function destroy(Pengajaran $pengajaran): RedirectResponse
    {
        $pengajaran->delete();

        return redirect()->route('pengajaran.index')
            ->with('success', 'Jadwal pengajaran berhasil dihapus.');
    }

    private function formOptions(): array
    {
        return [
            'guru' => Guru::orderBy('nama')->get(),
            'mapel' => MataPelajaran::with('jurusan')->orderBy('nama_mapel')->get(),
            'kelas' => Kelas::orderBy('nama_kelas')->get(),
            'hari' => self::HARI,
        ];
    }
}
