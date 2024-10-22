<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuratPengantarController;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\RedirectIfNotAuthenticated;

// Rute untuk autentikasi
Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login_proses'])->name('login.proses');
Route::get('/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/register', [LoginController::class, 'register_proses'])->name('register.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Rute untuk dashboard dan fitur yang memerlukan autentikasi
Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Rute untuk surat pengantar
    Route::get('/surat_pengantars', [SuratPengantarController::class, 'index'])->name('surat_pengantars.index');
    Route::get('/surat_pengantars/create', [SuratPengantarController::class, 'create'])->name('surat_pengantars.create');
    Route::post('/surat_pengantars', [SuratPengantarController::class, 'store'])->name('surat_pengantars.store');
    Route::get('/surat_pengantars/{id}', [SuratPengantarController::class, 'show'])->name('surat_pengantars.show');
    Route::get('/surat_pengantars/{id}/edit', [SuratPengantarController::class, 'edit'])->name('surat_pengantars.edit');
    Route::put('/surat_pengantars/{id}', [SuratPengantarController::class, 'update'])->name('surat_pengantars.update');
    Route::patch('/surat_pengantars/{id}/status', [SuratPengantarController::class, 'updateStatus'])->name('surat_pengantars.updateStatus');

    Route::delete('/surat_pengantars/{id}', [SuratPengantarController::class, 'destroy'])->name('surat_pengantars.destroy');

    // Rute untuk jenis layanan
    Route::get('/jenis_layanans', [JenisLayananController::class, 'index'])->name('jenis_layanans.index');
    Route::get('/jenis_layanans/create', [JenisLayananController::class, 'create'])->name('jenis_layanans.create');
    Route::post('/jenis_layanans', [JenisLayananController::class, 'store'])->name('jenis_layanans.store');
    Route::get('/jenis_layanans/{id}/edit', [JenisLayananController::class, 'edit'])->name('jenis_layanans.edit');
    Route::put('/jenis_layanans/{id}', [JenisLayananController::class, 'update'])->name('jenis_layanans.update');
    Route::delete('/jenis_layanans/{id}', [JenisLayananController::class, 'destroy'])->name('jenis_layanans.destroy');

    Route::get('/pengaduans', [PengaduanController::class, 'index'])->name('pengaduans.index');        // Menampilkan daftar pengaduan
    Route::get('/pengaduans/create', [PengaduanController::class, 'create'])->name('pengaduans.create'); // Menampilkan form untuk membuat pengaduan baru
    Route::post('/pengaduans', [PengaduanController::class, 'store'])->name('pengaduans.store');        // Menyimpan pengaduan baru
    Route::get('/pengaduans/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduans.edit');  // Menampilkan form untuk mengedit pengaduan
    Route::put('/pengaduans/{id}', [PengaduanController::class, 'update'])->name('pengaduans.update');   // Memperbarui pengaduan
    Route::delete('/pengaduans/{id}', [PengaduanController::class, 'destroy'])->name('pengaduans.destroy'); // Menghapus pengaduan

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);

});
