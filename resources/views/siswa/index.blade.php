@extends('layouts.header')
@section('title', 'Data Siswa')
@section('content')
<h1>Data Siswa</h1>
<a href="{{ route('siswa.create') }}">Tambah Siswa</a>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif
<table border=1>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Alamat</th>
        <th>No Telp</th>
        <th>Nama Orang tua</th>
        <th colspan="3">Aksi</th>
    </tr>
    @forelse ($siswa as $siswa)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $siswa->nama }}</th>
            <th>{{ $siswa->tempat_lahir }}</th>
            <th>{{ $siswa->tanggal_lahir }}</th>
            <th>{{ $siswa->jenis_kelamin }}</th>
            <th>{{ $siswa->agama }}</th>
            <th>{{ $siswa->alamat }}</th>
            <th>{{ $siswa->no_telp }}</th>
            <th>{{ $siswa->orangtua->nama }}</th>
            <td><a href="{{ route('siswa.edit', $siswa->id_siswa) }}">Edit</a></td>
            <td><a href="{{ route('siswa.show', $siswa->id_siswa) }}">Lihat</a></td>
            <td><form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus data {{ $siswa->nama }}?')">Hapus</button>
            </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10">
                <p>Data siswa masih kosong</p>
            </td>
        </tr>
    @endforelse
</table>
@endsection