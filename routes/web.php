<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriKerusakanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Laporan (Admin & Siswa)
    Route::resource('laporan', LaporanController::class);
});

// Khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('lokasi', LokasiController::class);

    Route::resource('kategori', KategoriKerusakanController::class);

    Route::resource('user', UserController::class);

    Route::resource('petugas', App\Http\Controllers\PetugasController::class);

});

require __DIR__.'/auth.php';