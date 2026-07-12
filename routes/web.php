<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
| Untuk sekarang '/' diarahkan ke etalase undangan.
| Kalau nanti punya landing nttdigital lengkap, ganti tujuannya di sini.
*/
Route::get('/', fn () => redirect()->route('landing.undangan'));

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
| Breeze mengarahkan ke route bernama 'dashboard' setelah login.
| Kita lempar langsung ke panel admin.
*/
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profil (bawaan Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Modul
|--------------------------------------------------------------------------
| CATATAN: route undangan publik (/u/{slug}) HANYA didaftarkan di
| undangan-web.php — jangan ditulis ulang di sini, karena nama route
| yang dobel membuat `php artisan route:cache` gagal.
*/
require __DIR__.'/undangan-web.php';   // /u/{slug}, rsvp, wishes
require __DIR__.'/landing.php';        // /undangan (etalase)
require __DIR__.'/admin.php';          // /admin/*
require __DIR__.'/sebar.php';          // /admin/undangan/{inv}/tamu
require __DIR__.'/auth.php';           // login, logout, register
