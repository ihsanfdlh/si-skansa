<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use Illuminate\Http\Request;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orangtua=Orangtua::All();
        return view('orangtua.index', compact('orangtua'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orangtua.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp',
        ]);

        Orangtua::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->route('orangtua.index')->with('success','Data berhasil di tambahkan');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Orangtua $orangtua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orangtua $orangtua)
    {
        return view('orangtua.edit', compact('orangtua'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orangtua $orangtua)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp',
        ]);

        $orangtua->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->route('orangtua.index')->with('success','Data berhasil di ubah');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orangtua $orangtua)
    {
        $orangtua->delete();
        return redirect()->route('orangtua.index')->with('success','Data berhasil di hapus');;
    }
}
