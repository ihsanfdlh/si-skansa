@extends('layouts.header')
@section('title', 'Tambah Data Kelas')
@section('content')
<h1>Tambah Data Kelas</h1>
<a href="{{ route('kelas.index') }}">kembali ke Kelas</a>
<form action="{{ route('kelas.store') }}" method="POST">
    @csrf
    <div>
        <label for="nama_kelas">Nama Kelas</label>
            <input id="nama_kelas" type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" placeholder="" required>
    </div>
    <div>
        <label for="tingkat">Tingkat</label>
            <input id="tingkat" type="text" name="tingkat" value="{{ old('tingkat') }}" placeholder="" required>
    </div>
    <div>
        <label for="tahun_ajaran">Tahun Ajaran</label>
            <input id="tahun_ajaran" type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" placeholder="" required>
    </div>
    <div>
        <label for="id_jurusan">Jurusan</label>
            <input id="id_jurusan" type="text" name="id_jurusan" value="{{ old('id_jurusan') }}" placeholder="">
    </div>
    <div>
        <label for="id_walikelas">Walikelas</label>
            <input id="id_walikelas" type="text" name="id_walikelas" value="{{ old('id_walikelas') }}" placeholder="">
    </div>
    <div>
        <button type="submit">Kirim</button>
    </div>
</form>
@endsection