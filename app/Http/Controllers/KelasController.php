<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('jurusan', 'guru')->get();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('kelas.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'tahun_ajaran' => 'required',
            'id_jurusan' => 'nullable',
            'id_walikelas' => 'required',
        ]);
        Kelas::create($request->all());
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        $kelas = $kela;
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        $jurusan = Jurusan::all();
        $kelas = $kela;
        return view('kelas.edit', compact('kelas', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'tahun_ajaran' => 'required',
            'id_jurusan' => 'nullable',
            'id_walikelas' => 'nullable',
        ]);
        $kela->update($request->all());
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus');
    }
}

