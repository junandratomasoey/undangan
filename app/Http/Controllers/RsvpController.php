<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RsvpController extends Controller
{
    /** POST /u/{invitation}/rsvp */
    public function store(Request $request, Invitation $invitation)
    {
        abort_unless($invitation->hasFeature('rsvp'), Response::HTTP_FORBIDDEN);

        $data = $request->validate([
            'name'       => ['required', 'string', 'max:120'],
            'attendance' => ['required', 'in:hadir,tidak_hadir,ragu'],
            'headcount'  => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $rsvp = $invitation->rsvps()->create([
            'name'       => $data['name'],
            'attendance' => $data['attendance'],
            'headcount'  => $data['headcount'] ?? 1,
        ]);

        return response()->json([
            'ok'      => true,
            'message' => 'Terima kasih, konfirmasi kamu sudah kami terima.',
            'summary' => $this->summary($invitation),
            'rsvp'    => $rsvp->only(['name', 'attendance', 'headcount']),
        ], Response::HTTP_CREATED);
    }

    private function summary(Invitation $invitation): array
    {
        $rows = $invitation->rsvps()->get();

        return [
            'hadir'       => $rows->where('attendance', 'hadir')->sum('headcount'),
            'tidak_hadir' => $rows->where('attendance', 'tidak_hadir')->count(),
            'ragu'        => $rows->where('attendance', 'ragu')->count(),
        ];
    }
}
