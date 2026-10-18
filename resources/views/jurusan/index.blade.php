@extends('layouts.header')
@section('title', 'Data Jurusan')
@section('content')
<h1>Data Jurusan</h1>
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
        <th>Kode Jurusan</th>
        <th>Nama Jurusan</th>
        <th>Kepala Jurusan</th>
        <!-- <th>Jumlah Siswa</th> -->
    </tr>
    @forelse ($jurusan as $jrs)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $jrs->kode_jurusan }}</th>
            <th>{{ $jrs->nama }}</th>
            <th>{{ $jrs->guru->nama }}</th>
            <!-- <th>{{ $jrs->jumlah_siswa }}</th> -->
        </tr>
    @empty
        <tr>
            <td colspan="5">
                <p>Data jurusan masih kosong</p>
            </td>
        </tr>
    @endforelse
</table>
@endsection