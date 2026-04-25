<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\DashboardController; // Pastikan ini di-import

// Redirect halaman utama ke dashboard (jika sudah login) atau login (jika belum)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Login Routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Harus Login)
Route::middleware(['auth'])->group(function () {
    
    // Gunakan DashboardController agar data statistik tampil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource Routes
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('matakuliah', MatakuliahController::class);
});