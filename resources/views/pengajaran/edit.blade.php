@extends('layouts.header')
@section('title', 'Edit Jadwal Pengajaran')
@section('content')
    @include('pengajaran._form', ['formTitle' => 'Edit Jadwal Pengajaran'])
@endsection
