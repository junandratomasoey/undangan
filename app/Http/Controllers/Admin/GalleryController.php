<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        $request->validate([
            'photos'   => ['required', 'array', 'max:12'],
            'photos.*' => ['image', 'max:4096'],
        ]);

        $start = (int) $invitation->photos()->max('sort');

        foreach ($request->file('photos') as $i => $file) {
            $invitation->photos()->create([
                'path' => $file->store("invitations/{$invitation->id}/gallery", 'public'),
                'sort' => $start + $i + 1,
            ]);
        }

        return back()->with('ok', 'Foto diunggah.');
    }

    public function destroy(Invitation $invitation, GalleryPhoto $photo)
    {
        abort_unless($photo->invitation_id === $invitation->id, 404);

        if (! str_starts_with($photo->path, 'http')) {
            Storage::disk('public')->delete($photo->path);
        }
        $photo->delete();

        return back()->with('ok', 'Foto dihapus.');
    }
}
