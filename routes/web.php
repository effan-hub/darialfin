<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::resource('/prodi', ProdiController::class)->except('index');
Route::get('/prodi', [ProdiController::class, 'index']);
Route::resource('/mahasiswa', MahasiswaController::class)->except('index');
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
