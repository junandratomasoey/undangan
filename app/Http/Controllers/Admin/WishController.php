<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Wish;

class WishController extends Controller
{
    public function index(Invitation $invitation)
    {
        // Query model langsung supaya yang di-hide ikut tampil untuk moderasi
        // (relasi $invitation->wishes() sudah difilter is_hidden=false).
        $wishes = Wish::where('invitation_id', $invitation->id)
            ->latest()
            ->paginate(30);

        return view('admin.wishes.index', compact('invitation', 'wishes'));
    }

    public function toggle(Invitation $invitation, Wish $wish)
    {
        abort_unless($wish->invitation_id === $invitation->id, 404);
        $wish->update(['is_hidden' => ! $wish->is_hidden]);

        return back()->with('ok', $wish->is_hidden ? 'Ucapan disembunyikan.' : 'Ucapan ditampilkan.');
    }

    public function destroy(Invitation $invitation, Wish $wish)
    {
        abort_unless($wish->invitation_id === $invitation->id, 404);
        $wish->delete();

        return back()->with('ok', 'Ucapan dihapus.');
    }
}
