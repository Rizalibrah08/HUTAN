<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporController;

// Public Routes
Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::prefix('lapor')->name('lapor.')->group(function () {
    Route::get('/', [LaporController::class, 'index'])->name('index');
    Route::post('/', [LaporController::class, 'store'])->name('store');
    Route::get('/verifikasi/dikirim', [LaporController::class, 'verificationSent'])->name('verifikasi.dikirim');
    Route::get('/verifikasi/{token}', [LaporController::class, 'verify'])->name('verify');
});

// BERITA ROUTES
// Public routes (bisa diakses semua user)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (harus login dulu)
Route::middleware(['auth'])->group(function () {
    // BERITA ADMIN ROUTES
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('berita.store'); // INI YANG DIBUTUHKAN!
    Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    
    // Dashboard admin
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');
});