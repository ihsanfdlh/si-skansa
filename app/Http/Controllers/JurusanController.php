<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::with('guru')->get();
        return view('jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = \App\Models\Guru::all();
        return view('jurusan.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => 'nullable|string|max:10|unique:jurusans,kode_jurusan',
            'nama' => 'required|string|max:50',
            'id_kepalajurusan' => 'required|exists:gurus,id_guru',
        ]);

        Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'nama' => $request->nama,
            'id_kepalajurusan' => $request->id_kepalajurusan,
        ]);

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        $jurusan->load('guru');
        return view('jurusan.show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        $guru = \App\Models\Guru::all();
        return view('jurusan.edit', compact('jurusan', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kode_jurusan' => 'nullable|string|max:10|unique:jurusans,kode_jurusan,' . $jurusan->id_jurusan . ',id_jurusan',
            'nama' => 'required|string|max:50',
            'id_kepalajurusan' => 'required|exists:gurus,id_guru',
        ]);

        $jurusan->update([
            'kode_jurusan' => $request->kode_jurusan,
            'nama' => $request->nama,
            'id_kepalajurusan' => $request->id_kepalajurusan,
        ]);

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil dihapus');
    }
}
