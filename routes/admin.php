<?php

/*
|--------------------------------------------------------------------------
| Admin routes — gabungkan ke routes/web.php kamu
|--------------------------------------------------------------------------
| Berasumsi Breeze/auth sudah terpasang. Semua di-gate 'auth'.
| Kalau mau batasi hanya admin tertentu, tambahkan middleware 'can:admin'
| atau gate custom (lihat catatan di README-admin).
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\GuestShareController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\RsvpController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\WishController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Invitations
    Route::get('undangan',                 [InvitationController::class, 'index'])->name('invitations.index');
    Route::get('undangan/baru',            [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('undangan',                [InvitationController::class, 'store'])->name('invitations.store');
    Route::get('undangan/{invitation}',    [InvitationController::class, 'edit'])->name('invitations.edit');
    Route::put('undangan/{invitation}',    [InvitationController::class, 'update'])->name('invitations.update');
    Route::delete('undangan/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');
    Route::post('undangan/{invitation}/publish', [InvitationController::class, 'togglePublish'])->name('invitations.publish');

    // Musik latar (upload/hapus)
    Route::delete('undangan/{invitation}/musik', [InvitationController::class, 'removeMusic'])->name('invitations.music.destroy');

    // Nested: events
    Route::post('undangan/{invitation}/acara',                [EventController::class, 'store'])->name('events.store');
    Route::put('undangan/{invitation}/acara/{event}',         [EventController::class, 'update'])->name('events.update');
    Route::delete('undangan/{invitation}/acara/{event}',      [EventController::class, 'destroy'])->name('events.destroy');

    // Nested: love story
    Route::post('undangan/{invitation}/cerita',               [StoryController::class, 'store'])->name('stories.store');
    Route::delete('undangan/{invitation}/cerita/{story}',     [StoryController::class, 'destroy'])->name('stories.destroy');

    // Nested: gift accounts
    Route::post('undangan/{invitation}/amplop',               [GiftController::class, 'store'])->name('gifts.store');
    Route::delete('undangan/{invitation}/amplop/{gift}',      [GiftController::class, 'destroy'])->name('gifts.destroy');

    // Nested: gallery
    Route::post('undangan/{invitation}/galeri',               [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('undangan/{invitation}/galeri/{photo}',     [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Recap: RSVP
    Route::get('undangan/{invitation}/rsvp',                  [RsvpController::class, 'index'])->name('rsvps.index');
    Route::get('undangan/{invitation}/rsvp/export',           [RsvpController::class, 'export'])->name('rsvps.export');
    Route::delete('undangan/{invitation}/rsvp/{rsvp}',        [RsvpController::class, 'destroy'])->name('rsvps.destroy');

    // Recap: wishes moderation
    Route::get('undangan/{invitation}/ucapan',                [WishController::class, 'index'])->name('wishes.index');
    Route::post('undangan/{invitation}/ucapan/{wish}/toggle', [WishController::class, 'toggle'])->name('wishes.toggle');
    Route::delete('undangan/{invitation}/ucapan/{wish}',      [WishController::class, 'destroy'])->name('wishes.destroy');

    // Tamu & Sebar Undangan (daftar tamu, link personal, kirim WA)
    Route::get('undangan/{invitation}/tamu',            [GuestShareController::class, 'index'])->name('guests.index');
    Route::post('undangan/{invitation}/tamu',           [GuestShareController::class, 'store'])->name('guests.store');
    Route::put('undangan/{invitation}/tamu/template',   [GuestShareController::class, 'updateTemplate'])->name('guests.template');
    Route::delete('undangan/{invitation}/tamu/{guest}', [GuestShareController::class, 'destroy'])->name('guests.destroy');
});
