<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TPSController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PengangkutanController;

/*
|--------------------------------------------------------------------------
| ROOT ROUTE
|--------------------------------------------------------------------------
| Belum login  -> login
| Sudah login  -> dashboard
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| ROUTE AUTH (SEMUA USER LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Riwayat Kapasitas
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('riwayat.index');
    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy'])
    ->name('riwayat.destroy');

    // Riwayat Pengangkutan
    Route::get('/pengangkutan', [PengangkutanController::class, 'index'])
        ->name('pengangkutan.index');
    Route::delete('/pengangkutan/{id}', [PengangkutanController::class, 'destroy'])
    ->name('pengangkutan.destroy');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/export', [LaporanController::class, 'export'])
        ->name('laporan.export');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('tps', TPSController::class);
    Route::resource('user', UserController::class);
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN, LOGOUT, REGISTER)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
