@extends('layouts.header')
@section('title', 'Tambah Jadwal Pengajaran')
@section('content')
    @include('pengajaran._form', ['pengajaran' => null, 'formTitle' => 'Tambah Jadwal Pengajaran'])
@endsection
