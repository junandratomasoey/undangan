<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class GuestShareController extends Controller
{
    private const DEFAULT_TEMPLATE =
        "Kepada Yth. {nama}\n\n".
        "Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami. Berikut undangan digital kami:\n\n".
        "{link}\n\n".
        "Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir. Terima kasih.";

    public function index(Invitation $invitation)
    {
        $template = $invitation->data_tambahan['wa_template'] ?? self::DEFAULT_TEMPLATE;

        $guests = $invitation->guests()->orderBy('name')->get()->map(function (Guest $g) use ($invitation, $template) {
            $link = url("/u/{$invitation->slug}") . '?to=' . rawurlencode($g->name);
            $message = strtr($template, ['{nama}' => $g->name, '{link}' => $link]);

            return [
                'model'   => $g,
                'link'    => $link,
                'message' => $message,
                'wa_url'  => $g->phone
                    ? 'https://wa.me/' . $this->normalizePhone($g->phone) . '?text=' . rawurlencode($message)
                    : null,
            ];
        });

        return view('admin.guests.share', [
            'invitation' => $invitation,
            'guests'     => $guests,
            'template'   => $template,
            'sent'       => $invitation->guests()->whereNotNull('phone')->count(),
        ]);
    }

    /** Tambah tamu massal. Satu baris = "Nama" atau "Nama, 08xxxx". */
    public function store(Request $request, Invitation $invitation)
    {
        $data = $request->validate([
            'entries' => ['required', 'string', 'max:10000'],
            'group'   => ['nullable', 'string', 'max:60'],
        ]);

        $lines = collect(preg_split('/\r\n|\r|\n/', $data['entries']))
            ->map(fn ($l) => trim($l))
            ->filter();

        $count = 0;
        foreach ($lines as $line) {
            [$name, $phone] = array_pad(array_map('trim', explode(',', $line, 2)), 2, null);
            if ($name === '' || $name === null) {
                continue;
            }
            $invitation->guests()->create([
                'name'  => $name,
                'phone' => $phone ?: null,
                'group' => $data['group'] ?? null,
            ]);
            $count++;
        }

        return back()->with('ok', "{$count} tamu ditambahkan.");
    }

    public function updateTemplate(Request $request, Invitation $invitation)
    {
        $data = $request->validate([
            'template' => ['required', 'string', 'max:2000'],
        ]);

        $invitation->update([
            'data_tambahan' => array_merge($invitation->data_tambahan ?? [], [
                'wa_template' => $data['template'],
            ]),
        ]);

        return back()->with('ok', 'Template pesan disimpan.');
    }

    public function destroy(Invitation $invitation, Guest $guest)
    {
        abort_unless($guest->invitation_id === $invitation->id, Response::HTTP_NOT_FOUND);
        $guest->delete();

        return back()->with('ok', 'Tamu dihapus.');
    }

    /**
     * Normalisasi nomor ke format internasional tanpa tanda +.
     * 08xx -> 628xx ; +62xx -> 62xx ; 8xx -> 628xx.
     */
    private function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone);

        if (Str::startsWith($digits, '0')) {
            return '62' . substr($digits, 1);
        }
        if (Str::startsWith($digits, '62')) {
            return $digits;
        }
        if (Str::startsWith($digits, '8')) {
            return '62' . $digits;
        }

        return $digits;
    }
}
