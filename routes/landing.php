<?php

/*
|--------------------------------------------------------------------------
| Etalase Undangan Digital
|--------------------------------------------------------------------------
| Tambahkan di routes/web.php:  require __DIR__.'/landing.php';
|
| Default ada di /undangan. Kalau mau jadikan halaman utama (/),
| ganti path '/undangan' menjadi '/' dan hapus route welcome bawaan.
*/

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/undangan', [LandingController::class, 'undangan'])->name('landing.undangan');
