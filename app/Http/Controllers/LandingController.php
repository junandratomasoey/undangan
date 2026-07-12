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
            ['key' => 'sasando', 'name' => 'Sasando',  'tag' => 'Midnight Garden',   'desc' => 'Elegan gelap dengan sentuhan teal & emas, nuansa romantis.', 'slug' => 'demo-sasando'],
            ['key' => 'tenun',   'name' => 'Tenun',    'tag' => 'NTT Heritage',      'desc' => 'Motif ikat khas NTT, marun-krem-oker. Kearifan lokal.',     'slug' => 'demo-tenun'],
            ['key' => 'modern',  'name' => 'Modern',   'tag' => 'Urban Minimalist',  'desc' => 'Bersih, tipografi besar, banyak ruang. Untuk pasangan urban.', 'slug' => 'demo-modern'],
            ['key' => 'aurum',   'name' => 'Aurum',    'tag' => 'Black & Gold',      'desc' => 'Hitam mewah dengan emas berkilau & font tulisan tangan.',   'slug' => 'demo-aurum'],
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
