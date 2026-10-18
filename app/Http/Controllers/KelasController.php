<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with(['jurusan', 'guru', 'siswa'])->get();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        return view('kelas.create', compact('jurusan', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas',
            'tingkat' => 'required|string|max:10',
            'tahun_ajaran' => 'required|string|max:20',
            'id_jurusan' => 'nullable|exists:jurusans,id_jurusan',
            'id_walikelas' => 'required|exists:gurus,id_guru',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'tahun_ajaran' => $request->tahun_ajaran,
            'id_jurusan' => $request->id_jurusan,
            'id_walikelas' => $request->id_walikelas,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource with students enrolled and eligible students to add.
     */
    public function show(Kelas $kelas)
    {
        $kelas->load(['jurusan', 'guru', 'siswa.jurusan', 'siswa.orangtua']);

        // Ambil siswa yang memiliki jurusan yang sama dengan jurusan kelas ini
        // dan belum berada di kelas ini
        $queryAvailable = Siswa::with('jurusan');

        if ($kelas->id_jurusan) {
            $queryAvailable->where('id_jurusan', $kelas->id_jurusan);
        }

        $availableSiswa = $queryAvailable
            ->where(function($q) use ($kelas) {
                $q->whereNull('id_kelas')
                  ->orWhere('id_kelas', '!=', $kelas->id_kelas);
            })
            ->get();

        return view('kelas.show', compact('kelas', 'availableSiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        return view('kelas.edit', compact('kelas', 'jurusan', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas,' . $kelas->id_kelas . ',id_kelas',
            'tingkat' => 'required|string|max:10',
            'tahun_ajaran' => 'required|string|max:20',
            'id_jurusan' => 'nullable|exists:jurusans,id_jurusan',
            'id_walikelas' => 'required|exists:gurus,id_guru',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'tahun_ajaran' => $request->tahun_ajaran,
            'id_jurusan' => $request->id_jurusan,
            'id_walikelas' => $request->id_walikelas,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus');
    }

    /**
     * Tambahkan siswa ke dalam kelas (Hanya yang jurusannya sesuai).
     */
    public function addSiswa(Request $request, Kelas $kelas)
    {
        $request->validate([
            'id_siswa' => 'required',
        ]);

        $siswaIds = is_array($request->id_siswa) ? $request->id_siswa : [$request->id_siswa];
        $addedCount = 0;

        foreach ($siswaIds as $id) {
            $siswa = Siswa::find($id);
            if ($siswa) {
                // Verifikasi kesesuaian jurusan siswa dengan jurusan kelas
                if ($kelas->id_jurusan && $siswa->id_jurusan != $kelas->id_jurusan) {
                    $namaJurusanKelas = $kelas->jurusan->nama ?? 'Kelas Ini';
                    $namaJurusanSiswa = $siswa->jurusan->nama ?? 'Tanpa Jurusan';
                    return redirect()->back()->with('error', "Gagal: Siswa '{$siswa->nama}' memiliki jurusan ({$namaJurusanSiswa}) yang berbeda dengan jurusan kelas ({$namaJurusanKelas}).");
                }

                $siswa->update(['id_kelas' => $kelas->id_kelas]);
                $addedCount++;
            }
        }

        return redirect()->back()
            ->with('success', "Berhasil menambahkan {$addedCount} siswa ke kelas {$kelas->nama_kelas}.");
    }

    /**
     * Keluarkan siswa dari kelas.
     */
    public function removeSiswa(Kelas $kelas, Siswa $siswa)
    {
        if ($siswa->id_kelas == $kelas->id_kelas) {
            $siswa->update(['id_kelas' => null]);
            return redirect()->back()
                ->with('success', "Siswa '{$siswa->nama}' berhasil dikeluarkan dari kelas {$kelas->nama_kelas}.");
        }

        return redirect()->back()->with('error', 'Siswa tidak ditemukan di kelas ini.');
    }
}
