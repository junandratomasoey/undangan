<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        $data = $this->validateData($request);
        $invitation->events()->create($data);

        return back()->with('ok', 'Acara ditambahkan.');
    }

    public function update(Request $request, Invitation $invitation, Event $event)
    {
        abort_unless($event->invitation_id === $invitation->id, 404);
        $event->update($this->validateData($request));

        return back()->with('ok', 'Acara diperbarui.');
    }

    public function destroy(Invitation $invitation, Event $event)
    {
        abort_unless($event->invitation_id === $invitation->id, 404);
        $event->delete();

        return back()->with('ok', 'Acara dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'type'       => ['required', Rule::in(['akad', 'resepsi', 'other'])],
            'title'      => ['required', 'string', 'max:80'],
            'starts_at'  => ['required', 'date'],
            'ends_at'    => ['nullable', 'date', 'after_or_equal:starts_at'],
            'venue_name' => ['required', 'string', 'max:150'],
            'address'    => ['nullable', 'string', 'max:255'],
            'lat'        => ['nullable', 'numeric', 'between:-90,90'],
            'lng'        => ['nullable', 'numeric', 'between:-180,180'],
            'maps_url'   => ['nullable', 'url', 'max:255'],
            'sort'       => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
