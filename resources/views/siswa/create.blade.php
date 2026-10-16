@extends('layouts.header')
@section('title', 'Tambah Data Siswa')
@section('content')
<h1>Tambah Data Siswa</h1>
<a href="{{ route('siswa.index') }}">kembali ke Siswa</a>
<form action="{{ route('siswa.store') }}" method="POST">
    @csrf
    <div>
        <label for="nama">Nama</label>
            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" placeholder="" required>
    </div>
    <div>
        <label for="tempat_lahir">Tempat Lahir</label>
            <input id="tempat_lahir" type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="" required>
    </div>
    <div>
        <label for="tanggal_lahir">Tanggal Lahir</label>
            <input id="tanggal_lahir" type="text" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Contoh: 01 Januari 2026" required>
    </div>
    <div>
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value=""></option>
            <option value="Laki-laki"
                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="Perempuan"
                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
    </div>
    <div>
        <label for="agama">Agama</label>
            <input id="agama" type="text" name="agama" value="{{ old('agama') }}" placeholder="" required>
    </div>
    <div>
        <label for="alamat">Alamat</label>
            <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" placeholder="" required>
    </div>
    <div>
        <label for="no_telp">No Telp</label>
            <input id="no_telp" type="text" name="no_telp" value="{{ old('no_telp') }}" placeholder="">
    </div>
    <div>
        <label for="id_orangtua">Orang tua</label>
        <select id="id_orangtua" name="id_orangtua">
            <option value=""></option>

            @foreach ($orangtua as $ort)
                <option value="{{ $ort->id_orangtua }}">
                    {{ $ort->nama }}
                </option>
            @endforeach

        </select>
    </div>
    <div>
        <button type="submit">Kirim</button>
    </div>
</form>
@endsection