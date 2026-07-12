<?php

return [

    'themes' => [
        'sasando'   => 'Sasando — Midnight Garden',
        'tenun'     => 'Tenun — NTT Heritage',
        'modern'    => 'Modern — Urban Minimalist',
        'aurum'     => 'Aurum — Black & Gold',
        'flora'     => 'Flora — Botanical Pastel',
        'retro'     => 'Retro — Groovy Seventies',
        'sanctuary' => 'Sanctuary — Kristiani',
        'nikkah'    => 'Nikkah — Islami',
    ],

    'plans' => [

        'silver' => [
            'price'    => 75_000,
            'features' => ['events', 'countdown', 'maps_link'],
        ],

        'gold' => [
            'price'    => 199_000,
            'features' => [
                'events', 'countdown', 'maps_link', 'map_embed',
                'rsvp', 'wishes', 'gallery',
            ],
        ],

        'platinum' => [
            'price'    => 449_000,
            'features' => [
                'events', 'countdown', 'maps_link', 'map_embed',
                'rsvp', 'wishes', 'gallery', 'love_story',
                'gift', 'music', 'guest_qr', 'custom_domain',
            ],
        ],
    ],

    'default_theme' => 'sasando',
    'default_plan'  => 'gold',
];
