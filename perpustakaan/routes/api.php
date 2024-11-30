<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PeminjamanController;
use App\Http\Controllers\Api\LoginController;  // Pastikan LoginController di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| API Routes                                                               |
|--------------------------------------------------------------------------|
| Register API routes here that will be loaded by the RouteServiceProvider.|
| These routes will be assigned to the "api" middleware group.            |
*/

Route::post('/login', [LoginController::class, 'index']);  // Menggunakan LoginController
Route::post('/signup', [AuthController::class, 'signup']); // Sign up menggunakan AuthController

Route::get('/buku_and_category', [DashboardController::class, 'buku_category']);
Route::get('/buku/category/{category}', [DashboardController::class, 'buku_filter_category']);
Route::get('/buku/detail/{id}', [DashboardController::class, 'buku_detail']);
Route::get('/buku/tersedia', [DashboardController::class, 'buku_tersedia']);
Route::get('/buku/ebook', [DashboardController::class, 'buku_ebook']);
Route::get('/buku/terpinjam/{user_id}', [PeminjamanController::class, 'bukuTerpinjam']);
Route::get('/notifikasi/{user_id}', [PeminjamanController::class, 'notifikasi']);
Route::get('/riwayat/{user_id}', [PeminjamanController::class, 'riwayat']);
Route::post('/tambah-waktu', [PeminjamanController::class, 'tambahWaktu']);
Route::post('/review', [PeminjamanController::class, 'review']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/buku', [DashboardController::class, 'index']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/pinjam-buku', [PeminjamanController::class, 'pinjamBuku']);
    Route::post('/kembalikan-buku', [PeminjamanController::class, 'kembalikanBuku']);
});

Route::get('/logout', [LoginController::class, 'logout']);  // Logout menggunakan LoginController
