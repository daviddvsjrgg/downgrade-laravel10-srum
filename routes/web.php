<?php

use App\Http\Controllers\Admin\AudioController;
use App\Http\Controllers\Admin\KoleksiController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PermintaanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController; // Added this line
use Illuminate\Support\Facades\Route;

Route::get('/create-storage-link', function () {
    $target = '../laravel/skripsi-risaUM/storage';
    $link = '../public_html/storage';

    if (file_exists($link)) {
        return 'Link sudah ada.';
    }

    symlink($target, $link);
    return 'Symbolic link berhasil dibuat.';
});

// Landing Page Controller
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/tentang-kami', [LandingController::class, 'about'])->name('landing.about');
Route::get('/panduan', [LandingController::class, 'guide'])->name('landing.guide');
Route::get('/pilih-bahasa', [LandingController::class, 'selectLanguage'])->name('landing.pilih.bahasa');
Route::get('/cari-audio', [LandingController::class, 'cariAudio'])->name('cari.audio');
Route::get('/hasil-audio', [LandingController::class, 'hasilAudio'])->name('hasil.audio');
Route::get('/permintaan-teks-lengkap/{audioId}', [LandingController::class, 'mintaPermintaanTeksLengkap'])->name('permintaan.teks.lengkap');
Route::post('/permintaan-teks-lengkap/{audioId}', [LandingController::class, 'kirimPermintaanTeksLengkap'])->name('kirim.permintaan.teks.lengkap');



// Auth Controller
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/hello', function () {
    return 'Hello world 2';
});

// Admin Dashboard Controller
Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/guide-admin', [AdminDashboardController::class, 'guideAdmin'])->name('admin.guide');
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('admin.profile');

    // Kelola Data Koleksi
    Route::resource('koleksi', KoleksiController::class)->names('admin.koleksi');
    Route::get('/show/koleksi/import', [KoleksiController::class, 'showImport'])->name('admin.koleksi.show.import');
    Route::post('/store/koleksi/import', [KoleksiController::class, 'storeImport'])->name('admin.koleksi.store.import');

    // Data Audio
    Route::resource('audio', AudioController::class)->names('admin.audio');
    Route::get('/audio/by-koleksi/create/{collectionId}', [AudioController::class, 'createByKoleksi'])->name('admin.audio.by.koleksi.create');
    Route::post('/audio/by-koleksi/store/{collectionId}', [AudioController::class, 'storeByKoleksi'])->name('admin.audio.by.koleksi.store');
    Route::post('/audio/test-tts', [AudioController::class, 'testTTS'])->name('admin.audio.testTTS');

    // Data Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa');

    // Permintaan Full Akses
    Route::resource('permintaan', PermintaanController::class)->names('admin.permintaan');
});
