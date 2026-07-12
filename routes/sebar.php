<?php

/*
|--------------------------------------------------------------------------
| Fitur Sebar Undangan (kelola tamu + kirim WA personal)
|--------------------------------------------------------------------------
| Tambahkan di routes/web.php:  require __DIR__.'/sebar.php';
*/

use App\Http\Controllers\Admin\GuestShareController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('undangan/{invitation}/tamu',            [GuestShareController::class, 'index'])->name('guests.index');
    Route::post('undangan/{invitation}/tamu',           [GuestShareController::class, 'store'])->name('guests.store');
    Route::put('undangan/{invitation}/tamu/template',   [GuestShareController::class, 'updateTemplate'])->name('guests.template');
    Route::delete('undangan/{invitation}/tamu/{guest}', [GuestShareController::class, 'destroy'])->name('guests.destroy');
});
