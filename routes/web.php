<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('dashboard');
})->name('home')->middleware('auth');

Route::resource('/prodi', ProdiController::class)->except('index')->middleware('Admin');
Route::get('/prodi', [ProdiController::class, 'index'])->middleware('auth');
Route::resource('/mahasiswa', MahasiswaController::class)->except('index')->middleware('Admin');
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
