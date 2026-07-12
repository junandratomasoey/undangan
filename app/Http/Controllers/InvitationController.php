<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class InvitationController extends Controller
{
    /**
     * Public invitation page. Resolved via slug route-model binding.
     * GET /u/{invitation}?to=Nama+Tamu
     */
    public function show(Request $request, Invitation $invitation)
    {
        abort_if($invitation->status !== 'published', Response::HTTP_NOT_FOUND);
        abort_if($invitation->isExpired(), Response::HTTP_GONE, 'Undangan sudah tidak aktif.');

        $theme = $invitation->theme;
        abort_unless(
            array_key_exists($theme, config('undangan.themes')) &&
            View::exists("themes.{$theme}.show"),
            Response::HTTP_NOT_FOUND,
            "Tema '{$theme}' tidak ditemukan."
        );

        // Eager-load only what the plan actually renders.
        $invitation->load('events');
        if ($invitation->hasFeature('gallery'))    $invitation->load('photos');
        if ($invitation->hasFeature('wishes'))     $invitation->load('wishes');
        if ($invitation->hasFeature('love_story')) $invitation->load('stories');
        if ($invitation->hasFeature('gift'))       $invitation->load('giftAccounts');

        // "?to=" personalization — no DB row needed for the simple case.
        $guestName = trim((string) $request->query('to')) ?: null;

        return view("themes.{$theme}.show", [
            'inv'       => $invitation,
            'guestName' => $guestName,
        ]);
    }
}
