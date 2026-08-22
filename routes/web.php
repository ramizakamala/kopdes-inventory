<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data Barang: lihat semua role, kelola hanya admin
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create')->middleware('role:admin');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store')->middleware('role:admin');
    Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit')->middleware('role:admin');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update')->middleware('role:admin');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy')->middleware('role:admin');

    // Barang Masuk & Barang Keluar (khusus admin)
    Route::middleware('role:admin')->group(function () {
        Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
        Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
        Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');

        Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
        Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang-keluar.create');
        Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
    });
});
