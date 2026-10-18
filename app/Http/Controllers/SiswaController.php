<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $siswa = Siswa::with(['orangtua', 'jurusan', 'kelas'])->get();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $orangtua = Orangtua::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('siswa.create', compact('orangtua', 'jurusan', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:20',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:20',
            'id_orangtua' => 'required|exists:orangtuas,id_orangtua',
            'id_jurusan' => 'nullable|exists:jurusans,id_jurusan',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_orangtua' => $request->id_orangtua,
            'id_jurusan' => $request->id_jurusan,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa->load(['orangtua', 'jurusan', 'kelas']);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $orangtua = Orangtua::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('siswa.edit', compact('orangtua', 'jurusan', 'kelas', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:20',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:20',
            'id_orangtua' => 'required|exists:orangtuas,id_orangtua',
            'id_jurusan' => 'nullable|exists:jurusans,id_jurusan',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_orangtua' => $request->id_orangtua,
            'id_jurusan' => $request->id_jurusan,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}
