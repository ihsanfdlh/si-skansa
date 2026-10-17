@extends('layouts.header')
@section('title', 'Data Guru')
@section('content')
<h1>Data Guru</h1>
<a href="{{ route('guru.create') }}">Tambah Guru</a>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif
@if (session()->has('error'))
<div class="alert alert-error">
    {{ session()->get('error') }}
</div>
@endif
<table border=1>
    <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Alamat</th>
        <th>No Telp</th>
        <th colspan="3">Aksi</th>
    </tr>
    @forelse ($guru as $guru)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $guru->nama }}</th>
            <th>{{ $guru->nip }}</th>
            <th>{{ $guru->tempat_lahir }}</th>
            <th>{{ $guru->tanggal_lahir }}</th>
            <th>{{ $guru->jenis_kelamin }}</th>
            <th>{{ $guru->agama }}</th>
            <th>{{ $guru->alamat }}</th>
            <th>{{ $guru->no_telp }}</th>
            <td><a href="{{ route('guru.edit', $guru->id_guru) }}">Edit</a></td>
            <td><a href="{{ route('guru.show', $guru->id_guru) }}">Lihat</a></td>
            <td><form action="{{ route('guru.destroy', $guru->id_guru) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus data {{ $guru->nama }}?')">Hapus</button>
            </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10">
                <p>Data guru masih kosong</p>
            </td>
        </tr>
    @endforelse
</table>
@endsection