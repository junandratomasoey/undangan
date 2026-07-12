<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    /** Label manusiawi untuk tiap fitur (key di config/undangan.php). */
    private const FEATURE_LABELS = [
        'events'        => 'Info acara (akad & resepsi)',
        'countdown'     => 'Hitung mundur hari-H',
        'maps_link'     => 'Tautan Google Maps',
        'map_embed'     => 'Peta lokasi interaktif',
        'rsvp'          => 'RSVP online + rekap kehadiran',
        'wishes'        => 'Buku ucapan & doa',
        'gallery'       => 'Galeri foto',
        'love_story'    => 'Love story timeline',
        'gift'          => 'Amplop digital (rekening & QRIS)',
        'music'         => 'Musik latar',
        'guest_qr'      => 'QR check-in tamu',
        'custom_domain' => 'Custom domain',
    ];

    public function undangan()
    {
        $themes = [
            [
                'key'  => 'sanctuary', 'name' => 'Sanctuary', 'tag' => 'Kristiani',
                'desc' => 'Jendela katedral, salib halus, biru batu & emas antik. Untuk pemberkatan yang khidmat.',
                'slug' => 'demo-sanctuary', 'kategori' => 'Religi',
            ],
            [
                'key'  => 'nikkah', 'name' => 'Nikkah', 'tag' => 'Islami',
                'desc' => 'Geometri girih, lengkung mihrab, hijau zamrud & emas. Lengkap dengan kaligrafi Arab.',
                'slug' => 'demo-nikkah', 'kategori' => 'Religi',
            ],
            [
                'key'  => 'tenun', 'name' => 'Tenun', 'tag' => 'NTT Heritage',
                'desc' => 'Motif ikat khas NTT, marun-krem-oker. Kearifan lokal yang membanggakan.',
                'slug' => 'demo-tenun', 'kategori' => 'Khas NTT',
            ],
            [
                'key'  => 'flora', 'name' => 'Flora', 'tag' => 'Botanical Pastel',
                'desc' => 'Dedaunan eucalyptus, sage & blush lembut. Romantis untuk konsep taman.',
                'slug' => 'demo-flora', 'kategori' => 'Klasik',
            ],
            [
                'key'  => 'sasando', 'name' => 'Sasando', 'tag' => 'Midnight Garden',
                'desc' => 'Elegan gelap dengan teal & emas. Nuansa romantis dan mewah.',
                'slug' => 'demo-sasando', 'kategori' => 'Klasik',
            ],
            [
                'key'  => 'aurum', 'name' => 'Aurum', 'tag' => 'Black & Gold',
                'desc' => 'Hitam mewah, emas berkilau, font tulisan tangan. Kesan black-tie.',
                'slug' => 'demo-aurum', 'kategori' => 'Mewah',
            ],
            [
                'key'  => 'modern', 'name' => 'Modern', 'tag' => 'Urban Minimalist',
                'desc' => 'Bersih, tipografi besar, banyak ruang. Untuk pasangan urban.',
                'slug' => 'demo-modern', 'kategori' => 'Modern',
            ],
            [
                'key'  => 'retro', 'name' => 'Retro', 'tag' => 'Groovy Seventies',
                'desc' => 'Mustard, terracotta, bentuk arch 70-an. Berani dan penuh karakter.',
                'slug' => 'demo-retro', 'kategori' => 'Modern',
            ],
        ];

        $plans = collect(config('undangan.plans'))->map(function ($plan, $key) {
            return [
                'key'      => $key,
                'name'     => ucfirst($key),
                'price'    => $plan['price'],
                'popular'  => $key === 'gold',
                'features' => collect($plan['features'])
                    ->map(fn ($f) => self::FEATURE_LABELS[$f] ?? $f)
                    ->all(),
            ];
        })->values();

        return view('landing.undangan', [
            'themes' => $themes,
            'plans'  => $plans,
            'wa'     => env('NTTDIGITAL_WA', '6281234567890'),
        ]);
    }
}
