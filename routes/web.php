<?php

use App\Http\Middleware\User;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\SuratPengantarController;
use App\Http\Middleware\RedirectIfNotAuthenticated;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita/view', [HomeController::class, 'lihat'])->name('berita.blog');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');


// Rute untuk autentikasi
Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login_proses'])->name('login.proses');
Route::get('/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/register', [LoginController::class, 'register_proses'])->name('register.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [LoginController::class, 'forgot_password'])->name('auth.forgot-password');
Route::post('/forgot-password-proses', [LoginController::class, 'forgot_password_proses'])->name('forgot-password-proses');

Route::get('/reset-password/{token}', [LoginController::class, 'reset_password'])->name('auth.reset-password');
Route::post('/reset-password-proses', [LoginController::class, 'reset_password_proses'])->name('reset-password-proses');

// Rute untuk dashboard dan fitur yang memerlukan autentikasi
Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Rute untuk surat pengantar
    Route::middleware(['permission:view_surat_pengantar'])->group(function () {
        Route::get('/surat_pengantars', [SuratPengantarController::class, 'index'])->name('surat_pengantars.index');
        // Route::get('/surat_pengantars/create', [SuratPengantarController::class, 'create'])->name('surat_pengantars.create');
        Route::post('/surat_pengantars', [SuratPengantarController::class, 'store'])->name('surat_pengantars.store');
    });

    Route::middleware(['permission:manage_surat_pengantar'])->group(function () {
        Route::get('/surat_pengantars/{id}', [SuratPengantarController::class, 'show'])->name('surat_pengantars.show');
        // Route::get('/surat_pengantars/{id}/edit', [SuratPengantarController::class, 'edit'])->name('surat_pengantars.edit');
        Route::put('/surat_pengantars/{id}', [SuratPengantarController::class, 'update'])->name('surat_pengantars.update');
        Route::patch('/surat_pengantars/{id}/status', [SuratPengantarController::class, 'updateStatus'])->name('surat_pengantars.updateStatus');
        Route::delete('/surat_pengantars/{id}', [SuratPengantarController::class, 'destroy'])->name('surat_pengantars.destroy');
        Route::get('/surat_pengantars/arsip', [SuratPengantarController::class, 'arsip'])->name('surat_pengantars.arsip');

    });

    // Rute untuk jenis layanan
    Route::middleware(['permission:view_jenis_layanan'])->group(function () {
        Route::get('/jenis_layanans', [JenisLayananController::class, 'index'])->name('jenis_layanans.index');
        // Route::get('/jenis_layanans/create', [JenisLayananController::class, 'create'])->name('jenis_layanans.create');
        Route::post('/jenis_layanans', [JenisLayananController::class, 'store'])->name('jenis_layanans.store');
    });

    Route::middleware(['permission:manage_jenis_layanan'])->group(function () {
        // Route::get('/jenis_layanans/{id}/edit', [JenisLayananController::class, 'edit'])->name('jenis_layanans.edit');
        Route::put('/jenis_layanans/{id}', [JenisLayananController::class, 'update'])->name('jenis_layanans.update');
        Route::delete('/jenis_layanans/{id}', [JenisLayananController::class, 'destroy'])->name('jenis_layanans.destroy');
    });

    // Rute untuk melihat dan membuat pengaduan (dapat diakses oleh semua pengguna)
    // Route::get('/pengaduans/create', [PengaduanController::class, 'create'])->name('pengaduans.create'); // Menampilkan form untuk membuat pengaduan baru
    Route::post('/pengaduans', [PengaduanController::class, 'store'])->name('pengaduans.store'); // Menyimpan pengaduan baru

    // Rute untuk mengedit dan menghapus pengaduan (dapat dibatasi menggunakan middleware)
    Route::middleware(['permission:manage_pengaduan'])->group(function () {
        Route::get('/pengaduans', [PengaduanController::class, 'index'])->name('pengaduans.index'); // Menampilkan daftar pengaduan
        // Route::get('/pengaduans/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduans.edit'); // Menampilkan form untuk mengedit pengaduan
        Route::put('/pengaduans/{id}', [PengaduanController::class, 'update'])->name('pengaduans.update'); // Memperbarui pengaduan
        Route::delete('/pengaduans/{id}', [PengaduanController::class, 'destroy'])->name('pengaduans.destroy'); // Menghapus pengaduan
    });

    Route::middleware(['permission:view_profile'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    });

    Route::middleware(['permission:edit_profile'])->group(function () {
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware([Admin::class])->group(function () {

        // Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        // Route::resource('/roles', RoleController::class);
        // Route::resource('/permissions', PermissionController::class);
        Route::resource('/warga', WargaController::class);
        Route::resource('/pegawai', PegawaiController::class);
        Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
        Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
        Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{slug}', [BeritaController::class, 'destroy'])->name('berita.destroy');


    });
    Route::fallback(function () {
        return response()->view('error.404', [], 404);
    });
});
