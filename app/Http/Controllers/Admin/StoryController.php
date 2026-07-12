<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\LoveStory;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        $invitation->stories()->create($this->validateData($request));

        return back()->with('ok', 'Cerita ditambahkan.');
    }

    public function destroy(Invitation $invitation, LoveStory $story)
    {
        abort_unless($story->invitation_id === $invitation->id, 404);
        $story->delete();

        return back()->with('ok', 'Cerita dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title'      => ['required', 'string', 'max:80'],
            'date_label' => ['nullable', 'string', 'max:40'],
            'body'       => ['required', 'string', 'max:600'],
            'sort'       => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
