<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WishController extends Controller
{
    /** POST /u/{invitation}/wishes */
    public function store(Request $request, Invitation $invitation)
    {
        abort_unless($invitation->hasFeature('wishes'), Response::HTTP_FORBIDDEN);

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:500'],
        ]);

        $wish = $invitation->wishes()->create($data);

        return response()->json([
            'ok'   => true,
            'wish' => [
                'name'    => $wish->name,
                'message' => $wish->message,
                'ago'     => $wish->created_at->diffForHumans(),
            ],
        ], Response::HTTP_CREATED);
    }
}
