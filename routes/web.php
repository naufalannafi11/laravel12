<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PemeriksaanController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum (untuk semua role yang login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Autentikasi (login, register, dll)
Auth::routes();

// Home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk Dokter (CRUD Pemeriksaan & Obat)
Route::prefix('dokter')->middleware(['auth'])->name('dokter.')->group(function () {
    Route::get('/', [HomeController::class, 'dokter'])->name('index');
    Route::get('/dashboard', fn() => view('dokter.dashboard'))->name('dashboard');

    // CRUD Obat & Pemeriksaan
    Route::resource('obat', ObatController::class)->names('obat');
    Route::resource('periksa', PeriksaController::class)->names('periksa');
});

// Rute untuk Pasien melihat & minta pemeriksaan
Route::middleware('auth')->group(function () {
    Route::get('/periksa', [PemeriksaanController::class, 'index'])->name('periksa');
    Route::post('/periksa', [PemeriksaanController::class, 'store'])->name('periksa.store');
});
