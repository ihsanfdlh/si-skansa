@extends('layouts.header')
@section('title', 'Edit Nilai Siswa')
@section('content')
    @include('nilai._form', ['formTitle' => 'Edit Nilai Siswa'])
@endsection
