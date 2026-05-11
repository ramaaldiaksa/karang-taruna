<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventarisController as AdminInventarisController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PengembalianController as AdminPengembalianController;
use App\Http\Controllers\Admin\SuratController as AdminSuratController;
use App\Http\Controllers\Admin\KeuanganController as AdminKeuanganController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\InventarisController as PublicInventarisController;
use App\Http\Controllers\Public\PeminjamanController as PublicPeminjamanController;
use App\Http\Controllers\Public\KeuanganController as PublicKeuanganController;
use App\Http\Controllers\Public\BeritaController as PublicBeritaController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/inventaris', [PublicInventarisController::class, 'index'])->name('public.inventaris');
Route::get('/peminjaman/buat', [PublicPeminjamanController::class, 'create'])->name('public.peminjaman.create');
Route::post('/peminjaman/buat', [PublicPeminjamanController::class, 'store'])->name('public.peminjaman.store');
Route::get('/keuangan', [PublicKeuanganController::class, 'index'])->name('public.keuangan');
Route::get('/berita', [PublicBeritaController::class, 'index'])->name('public.berita');
Route::get('/berita/{slug}', [PublicBeritaController::class, 'show'])->name('public.berita.show');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('inventaris', AdminInventarisController::class);
    Route::resource('surat', AdminSuratController::class);
    Route::resource('keuangan', AdminKeuanganController::class);
    Route::resource('berita', AdminBeritaController::class);
    
    // Peminjaman
    Route::get('peminjaman', [AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/{id}/verifikasi', [AdminPeminjamanController::class, 'verifikasiForm'])->name('peminjaman.verifikasi_form');
    Route::post('peminjaman/{id}/verifikasi', [AdminPeminjamanController::class, 'verifikasi'])->name('peminjaman.verifikasi');
    
    // Pengembalian
    Route::get('pengembalian', [AdminPengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('pengembalian/riwayat', [AdminPengembalianController::class, 'riwayat'])->name('pengembalian.riwayat');
    Route::get('pengembalian/buat', [AdminPengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('pengembalian/buat', [AdminPengembalianController::class, 'store'])->name('pengembalian.store');
});
