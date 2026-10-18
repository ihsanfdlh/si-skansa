<?php

use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/siswa', SiswaController::class);

Route::resource('/orangtua', OrangtuaController::class);

Route::resource('/guru', GuruController::class);

Route::resource('/jurusan', JurusanController::class);

Route::resource('/kelas', KelasController::class)->parameters(['kelas' => 'kelas']);

// Manajemen Siswa dalam Kelas (Sesuai Jurusan)
Route::post('/kelas/{kelas}/siswa', [KelasController::class, 'addSiswa'])->name('kelas.add-siswa');
Route::delete('/kelas/{kelas}/siswa/{siswa}', [KelasController::class, 'removeSiswa'])->name('kelas.remove-siswa');