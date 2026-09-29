<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PresensiController;

Route::get('/', function () {
    return view('presensi');
});

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('presensi', PresensiController::class);
