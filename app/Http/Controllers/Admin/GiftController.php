<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftAccount;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GiftController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        $data = $request->validate([
            'kind'           => ['required', Rule::in(['bank', 'ewallet', 'qris', 'address'])],
            'label'          => ['required', 'string', 'max:60'],
            'account_name'   => ['nullable', 'string', 'max:120'],
            'account_number' => ['nullable', 'string', 'max:60'],
            'note'           => ['nullable', 'string', 'max:255'],
            'qris_image'     => ['nullable', 'image', 'max:2048'],
            'sort'           => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('qris_image')) {
            $data['qris_image'] = $request->file('qris_image')
                ->store("invitations/{$invitation->id}/qris", 'public');
        }

        $invitation->giftAccounts()->create($data);

        return back()->with('ok', 'Metode hadiah ditambahkan.');
    }

    public function destroy(Invitation $invitation, GiftAccount $gift)
    {
        abort_unless($gift->invitation_id === $invitation->id, 404);
        $gift->delete();

        return back()->with('ok', 'Metode hadiah dihapus.');
    }
}
