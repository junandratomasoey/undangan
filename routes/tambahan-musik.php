<?php

/*
|--------------------------------------------------------------------------
| Tambahan route: hapus musik
|--------------------------------------------------------------------------
| Tambahkan SATU baris ini ke routes/admin.php, di dalam grup
| Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(...)
| — taruh di dekat baris admin.invitations.update supaya mudah ditemukan:
*/

Route::delete('undangan/{invitation}/musik', [\App\Http\Controllers\Admin\InvitationController::class, 'removeMusic'])
    ->name('invitations.music.destroy');
