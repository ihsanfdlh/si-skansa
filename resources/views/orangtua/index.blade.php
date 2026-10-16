@extends('layouts.header')
@section('title', 'Data Orang tua')
@section('content')
<h1>Data Orang tua</h1>
<a href="{{ route('orangtua.create') }}">Tambah Orang tua</a>
<table border=1>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>No Telp</th>
    </tr>
    @forelse ($orangtua as $ort)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $ort->nama }}</th>
            <th>{{ $ort->tempat_lahir }}</th>
            <th>{{ $ort->tanggal_lahir }}</th>
            <th>{{ $ort->no_telp }}</th>
        </tr>
    @empty
        <tr>
            <td colspan="5">
                <p>Data orang tua masih kosong</p>
            </td>
        </tr>
    @endforelse
</table>
@endsection