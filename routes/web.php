<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\PengajaranController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/siswa', SiswaController::class);

Route::resource('/orangtua', OrangtuaController::class);

Route::resource('/guru', GuruController::class);

Route::resource('/jurusan', JurusanController::class);

Route::resource('/kelas', KelasController::class)->parameters(['kelas' => 'kelas']);

Route::resource('/pengajaran', PengajaranController::class)->except(['show']);

Route::resource('/nilai', NilaiController::class)->except(['show']);

// Manajemen Siswa dalam Kelas (Sesuai Jurusan)
Route::post('/kelas/{kelas}/siswa', [KelasController::class, 'addSiswa'])->name('kelas.add-siswa');
Route::delete('/kelas/{kelas}/siswa/{siswa}', [KelasController::class, 'removeSiswa'])->name('kelas.remove-siswa');
