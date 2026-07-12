<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

Route::prefix('u')->group(function () {
    Route::get('/{invitation}', [InvitationController::class, 'show'])->name('invitation.show');
    Route::post('/{invitation}/rsvp', [RsvpController::class, 'store'])->name('invitation.rsvp');
    Route::post('/{invitation}/wishes', [WishController::class, 'store'])->name('invitation.wishes');
});
