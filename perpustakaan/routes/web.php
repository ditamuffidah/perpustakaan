<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Fe\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlarifikasiController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;

Route::get('/fe/dashboard', [DashboardController::class, 'index'])->name('fe.dashboard');
Route::get('/warning', [DashboardController::class, 'warning'])->name('warning');
Route::get('/peminjaman', [DashboardController::class, 'peminjaman'])->name('peminjaman');
Route::get('/notifikasi', [DashboardController::class, 'notifikasi'])->name('notifikasi');
Route::get('/catalog/{category}', [DashboardController::class, 'catalog'])->name('catalog');


Route::get('/', function () {
    return view('welcome');
});

// Rute untuk otentikasi
Route::controller(AuthController::class)->group(function () {
    // Rute untuk otentikasi (registrasi)
    Route::get('register', 'register')->name('register');
    Route::post('register', 'register')->name('register');

    // Rute untuk otentikasi (login)
    Route::get('login', 'login')->name('login');
    Route::post('login', 'login')->name('login');

    // Rute untuk otentikasi (logout)
    Route::get('logout', 'logout')->name('logout');
    Route::post('logout', 'logout')->middleware('auth')->name('logout');
});

// Rute untuk profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk halaman admin dengan middleware role
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


// Rute untuk halaman guru dengan middleware role
Route::middleware(['auth', 'verified', 'role:guru|admin'])->group(function () {
    Route::get('/guru', [GuruController::class, 'dashboard'])->name('guru.dashboard');
});


// Rute untuk melihat data dengan middleware permission
Route::middleware(['auth', 'verified', 'role_or_permission:lihat_data|admin'])->group(function () {
    Route::get('data', function () {
        return view('data');
    })->name('data.show');
});

Route::middleware('auth')->group(function () {
    // Rute untuk halaman utama (dashboard)
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::controller(PeminjamanController::class)->prefix('peminjaman')->group(function () {
        Route::get('', 'index')->name('peminjaman');
        Route::get('tolak/{id}', 'tolak')->name('peminjaman.tolak');
        Route::get('terima/{id}', 'terima')->name('peminjaman.terima');
    });
    // Rute untuk modul buku
    Route::controller(BukuController::class)->prefix('buku')->group(function () {
        Route::get('', 'index')->name('buku');
        Route::get('tambah', 'tambah')->name('buku.tambah');
        Route::post('tambah', 'simpan')->name('buku.tambah.simpan');
        Route::get('edit/{id}', 'edit')->name('buku.edit');
        Route::put('edit/{id}', 'update')->name('buku.update');
        Route::get('hapus/{id}', 'hapus')->name('buku.hapus');
    });

    Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
        Route::get('', 'index')->name('kategori');
        Route::get('tambah', 'tambah')->name('kategori.tambah');
        Route::post('tambah', 'simpan')->name('kategori.tambah.simpan');
        Route::get('edit/{id}', 'edit')->name('kategori.edit');
        Route::post('edit/{id}', 'update')->name('kategori.tambah.update');
        Route::get('hapus/{id}', 'hapus')->name('kategori.hapus');
    });
});

// Route untuk menampilkan daftar
Route::get('/pengarang', [PengarangController::class, 'index'])->name('pengarang.index');
Route::get('/subjects', [SubjectController::class, 'index']);

Route::resource('klarifikasi', KlarifikasiController::class);
Route::post('/pengarang/store', [PengarangController::class, 'store'])->name('pengarang.store');
Route::post('/penerbit/store', [PenerbitController::class, 'store'])->name('penerbit.store');

// Include rute otentikasi standar dari Laravel
require __DIR__ . '/auth.php';
