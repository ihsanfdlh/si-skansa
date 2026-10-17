@extends('layouts.header')
@section('title', 'Tambah Data Guru')
@section('content')
<h1>Update Data Guru</h1>
<a href="{{ route('guru.index') }}">kembali ke Guru</a>
<form action="{{ route('guru.update', $guru->id_guru) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="nama">Nama</label>
            <input id="nama" type="text" name="nama" value="{{ old('nama', $guru->nama) }}" placeholder="" required>
    </div>
    <div>
        <label for="nip">NIP</label>
            <input id="nip" type="text" name="nip" value="{{ old('nip', $guru->nip) }}" placeholder="" required>
    </div>
    <div>
        <label for="tempat_lahir">Tempat Lahir</label>
            <input id="tempat_lahir" type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}" placeholder="" required>
    </div>
    <div>
        <label for="tanggal_lahir">Tanggal Lahir</label>
            <input id="tanggal_lahir" type="text" name="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" placeholder="Contoh: 01 Januari 2026" required>
    </div>
    <div>
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value=""></option>
            <option value="Laki-laki"
                {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="Perempuan"
                {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
    </div>
    <div>
        <label for="agama">Agama</label>
            <input id="agama" type="text" name="agama" value="{{ old('agama', $guru->agama) }}" placeholder="" required>
    </div>
    <div>
        <label for="alamat">Alamat</label>
            <input id="alamat" type="text" name="alamat" value="{{ old('alamat', $guru->alamat) }}" placeholder="" required>
    </div>
    <div>
        <label for="no_telp">No Telp</label>
            <input id="no_telp" type="text" name="no_telp" value="{{ old('no_telp', $guru->no_telp) }}" placeholder="">
    </div>
    <div>
        <button type="submit">Kirim</button>
    </div>
</form>
@endsection