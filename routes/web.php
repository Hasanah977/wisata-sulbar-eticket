<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Petugas\AuthController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\DestinationManageController;
use App\Http\Controllers\Petugas\ScanController;
use Illuminate\Support\Facades\Route;

// Halaman Publik Pembeli (Tanpa Login)
Route::get('/', [DestinationController::class, 'index'])->name('home');
Route::get('/destinasi/{slug}', [DestinationController::class, 'show'])->name('destinations.show');
Route::post('/pesan', [OrderController::class, 'store'])->name('orders.store');
Route::get('/pembayaran/{booking_code}', [OrderController::class, 'payment'])->name('orders.payment');
Route::post('/pembayaran/{booking_code}/konfirmasi', [OrderController::class, 'confirmPayment'])->name('orders.confirm');
Route::get('/tiket/{booking_code}', [OrderController::class, 'ticket'])->name('orders.ticket');
Route::get('/cek-tiket', [OrderController::class, 'check'])->name('orders.check');

// Autentikasi Petugas
Route::get('/petugas/login', [AuthController::class, 'showLogin'])->name('petugas.login');
Route::post('/petugas/login', [AuthController::class, 'login'])->name('petugas.login.submit');
Route::post('/petugas/logout', [AuthController::class, 'logout'])->name('petugas.logout');

// Portal Operasional Petugas (Wajib Login)
Route::middleware('auth')->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/orders/{order}/approve', [DashboardController::class, 'approvePayment'])->name('orders.approve');
    Route::post('/orders/{order}/reject', [DashboardController::class, 'rejectPayment'])->name('orders.reject');

    Route::resource('destinations', DestinationManageController::class)->except(['show']);

    Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan/verify', [ScanController::class, 'verify'])->name('scan.verify');
});
