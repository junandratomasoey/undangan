<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Rsvp;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RsvpController extends Controller
{
    public function index(Invitation $invitation)
    {
        $rsvps = $invitation->rsvps()->paginate(30);

        $summary = [
            'hadir'       => (int) $invitation->rsvps()->where('attendance', 'hadir')->sum('headcount'),
            'tidak_hadir' => $invitation->rsvps()->where('attendance', 'tidak_hadir')->count(),
            'ragu'        => $invitation->rsvps()->where('attendance', 'ragu')->count(),
            'entries'     => $invitation->rsvps()->count(),
        ];

        return view('admin.rsvps.index', compact('invitation', 'rsvps', 'summary'));
    }

    /** Export CSV — ringan, tanpa maatwebsite/excel. */
    public function export(Invitation $invitation): StreamedResponse
    {
        $filename = 'rsvp-' . $invitation->slug . '.csv';

        return response()->streamDownload(function () use ($invitation) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Nama', 'Kehadiran', 'Jumlah', 'Waktu']);

            $invitation->rsvps()->chunk(200, function ($rows) use ($out) {
                foreach ($rows as $r) {
                    fputcsv($out, [$r->name, $r->attendance, $r->headcount, $r->created_at]);
                }
            });

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function destroy(Invitation $invitation, Rsvp $rsvp)
    {
        abort_unless($rsvp->invitation_id === $invitation->id, 404);
        $rsvp->delete();

        return back()->with('ok', 'Entri RSVP dihapus.');
    }
}
