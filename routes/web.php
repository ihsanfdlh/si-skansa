<?php

use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/siswa', SiswaController::class);

Route::resource('/orangtua', OrangtuaController::class);

Route::resource('/guru', GuruController::class);

route::resource('/jurusan', JurusanController::class);