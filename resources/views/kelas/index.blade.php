@extends('layouts.header')
@section('title', 'Data Kelas')
@section('content')
<h1>Data Kelas</h1>
<a href="{{ route('kelas.create') }}">Tambah Kelas</a>
@if (session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-error">
    {{ session()->get('error') }}
</div>
@endif
<table border=1>
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Tingkat</th>
        <th>Tahun Ajaran</th>
        <th>Jurusan</th>
        <th>Walikelas</th>
        <th colspan="3">opsi</th>
    </tr>
    @forelse ($kelas as $kss)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $kss->nama_kelas }}</th>
            <th>{{ $kss->tingkat }}</th>
            <th>{{ $kss->tahun_ajaran }}</th>
            <th>{{ $kss->jurusan }}</th>
            <th>{{ $kss->walikelas }}</th>
            <td><a href="{{ route('kelas.edit', $kss->id_kelas) }}">Edit</a></td>
            <td><a href="{{ route('kelas.show', $kss->id_kelas) }}">Lihat</a></td>
            <td><form action="{{ route('kelas.destroy', $kss->id_kelas) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus data {{ $kss->nama_kelas }}?')">Hapus</button>
            </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">
                <p>Data kelas masih kosong</p>
            </td>
        </tr>
    @endforelse
</table>
@endsection