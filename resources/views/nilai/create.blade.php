@extends('layouts.header')
@section('title', 'Tambah Nilai Siswa')
@section('content')
    @include('nilai._form', ['nilai' => null, 'formTitle' => 'Tambah Nilai Siswa'])
@endsection
