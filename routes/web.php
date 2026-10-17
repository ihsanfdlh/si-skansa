<?php

use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/siswa', SiswaController::class);

Route::resource('/orangtua', OrangtuaController::class);

Route::resource('/guru', GuruController::class);