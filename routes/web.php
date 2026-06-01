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
Route::get('/peminjaman/{id}/sukses', [PublicPeminjamanController::class, 'success'])->name('public.peminjaman.success');
Route::get('/keuangan', [PublicKeuanganController::class, 'index'])->name('public.keuangan');
Route::get('/berita', [PublicBeritaController::class, 'index'])->name('public.berita');
Route::get('/berita/{slug}', [PublicBeritaController::class, 'show'])->name('public.berita.show');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Forgot & Reset Password Routes
Route::get('/admin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/admin/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/admin/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/admin/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD berbasis modal di halaman index (tanpa halaman create/edit/show terpisah)
    Route::resource('inventaris', AdminInventarisController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('surat', AdminSuratController::class)->only(['index', 'store', 'destroy']);
    Route::resource('keuangan', AdminKeuanganController::class)->only(['index', 'store', 'destroy']);
    Route::resource('berita', AdminBeritaController::class)->only(['index', 'store', 'update', 'destroy']);

    // Peminjaman
    Route::get('peminjaman', [AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('peminjaman/{id}/verifikasi', [AdminPeminjamanController::class, 'verifikasi'])->name('peminjaman.verifikasi');

    // Pengembalian
    Route::get('pengembalian', [AdminPengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('riwayat', [AdminPengembalianController::class, 'riwayat'])->name('riwayat.index');
    Route::post('pengembalian/buat', [AdminPengembalianController::class, 'store'])->name('pengembalian.store');
});
