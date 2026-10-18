@extends('layouts.header')
@section('title', 'Data Orang tua')
@section('content')
<h1>Data Orang tua</h1>
<a href="{{ route('orangtua.create') }}">Tambah Orang tua</a>
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
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>No Telp</th>
        <th colspan="3">opsi</th>
    </tr>
    @forelse ($orangtua as $ort)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $ort->nama }}</th>
            <th>{{ $ort->tempat_lahir }}</th>
            <th>{{ $ort->tanggal_lahir }}</th>
            <th>{{ $ort->no_telp }}</th>
            <td><a href="{{ route('orangtua.edit', $ort->id_orangtua) }}">Edit</a></td>
            <td><a href="{{ route('orangtua.show', $ort->id_orangtua) }}">Lihat</a></td>
            <td><form action="{{ route('orangtua.destroy', $ort->id_orangtua) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus data {{ $ort->nama }}?')">Hapus</button>
            </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">
                <p>Data orang tua masih kosong</p>
            </td>
        </tr>
    @endforelse
</table>
@endsection