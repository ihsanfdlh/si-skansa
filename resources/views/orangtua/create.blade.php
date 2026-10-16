@extends('layouts.header')
@section('title', 'Tambah Data Orang tua')
@section('content')
<h1>Tambah Data Siswa</h1>
<a href="{{ route('orangtua.index') }}">kembali ke Orang tua</a>
<form action="{{ route('orangtua.store') }}" method="POST">
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
            <input id="tanggal_lahir" type="text" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="" required>
    </div>
    <div>
        <label for="no_telp">No Telp</label>
            <input id="no_telp" type="text" name="no_telp" value="{{ old('no_telp') }}" placeholder="">
    </div>
    <div>
        <button type="submit">Kirim</button>
    </div>
</form>
@endsection