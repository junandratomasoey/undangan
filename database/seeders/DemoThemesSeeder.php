<?php

namespace Database\Seeders;

use App\Models\Invitation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoThemesSeeder extends Seeder
{
    public function run(): void
    {
        $demos = [
            [
                'theme' => 'sanctuary', 'slug' => 'demo-sanctuary',
                'groom' => 'Michael Sanam', 'bride' => 'Gabriela Nope', 'accent' => '#B79457',
                'acara1' => 'Pemberkatan Nikah', 'venue1' => 'Gereja Katedral Kupang',
            ],
            [
                'theme' => 'nikkah', 'slug' => 'demo-nikkah',
                'groom' => 'Reza Alfarizi', 'bride' => 'Nadia Salsabila', 'accent' => '#C0A053',
                'acara1' => 'Akad Nikah', 'venue1' => 'Masjid Raya Nurul Iman',
            ],
            [
                'theme' => 'tenun', 'slug' => 'demo-tenun',
                'groom' => 'Yosef Tefa', 'bride' => 'Maria Bria', 'accent' => '#C6892C',
                'acara1' => 'Akad Nikah', 'venue1' => 'Kediaman Mempelai Wanita',
            ],
            [
                'theme' => 'flora', 'slug' => 'demo-flora',
                'groom' => 'Rian Pratama', 'bride' => 'Sinta Maharani', 'accent' => '#C98B7E',
                'acara1' => 'Akad Nikah', 'venue1' => 'Kediaman Mempelai Wanita',
            ],
            [
                'theme' => 'sasando', 'slug' => 'demo-sasando',
                'groom' => 'Andi Prasetya', 'bride' => 'Sinta Maharani', 'accent' => '#C8A04B',
                'acara1' => 'Akad Nikah', 'venue1' => 'Kediaman Mempelai Wanita',
            ],
            [
                'theme' => 'aurum', 'slug' => 'demo-aurum',
                'groom' => 'Michael Sanam', 'bride' => 'Gabriela Nope', 'accent' => '#D4AF37',
                'acara1' => 'Pemberkatan', 'venue1' => 'Gereja Kupang',
            ],
            [
                'theme' => 'modern', 'slug' => 'demo-modern',
                'groom' => 'Reza Alvaro', 'bride' => 'Nadia Putri', 'accent' => '#B08D6A',
                'acara1' => 'Akad Nikah', 'venue1' => 'Kediaman Mempelai Wanita',
            ],
            [
                'theme' => 'retro', 'slug' => 'demo-retro',
                'groom' => 'Rian Adiputra', 'bride' => 'Dewi Anggraini', 'accent' => '#E3A72F',
                'acara1' => 'Akad Nikah', 'venue1' => 'Kediaman Mempelai Wanita',
            ],
        ];

        foreach ($demos as $d) {
            $inv = Invitation::updateOrCreate(
                ['slug' => $d['slug']],
                [
                    'theme'        => $d['theme'],
                    'plan'         => 'platinum',   // demo menampilkan semua fitur
                    'status'       => 'published',
                    'groom_name'   => $d['groom'],
                    'groom_short'  => Str::before($d['groom'], ' '),
                    'bride_name'   => $d['bride'],
                    'bride_short'  => Str::before($d['bride'], ' '),
                    'accent_color' => $d['accent'],
                    'expires_at'   => now()->addYears(5),
                    'data_tambahan' => [
                        'groom_parents' => 'Bpk. & Ibu (orang tua mempelai pria)',
                        'bride_parents' => 'Bpk. & Ibu (orang tua mempelai wanita)',
                    ],
                ]
            );

            $inv->events()->delete();
            $inv->stories()->delete();
            $inv->photos()->delete();
            $inv->giftAccounts()->delete();

            $inv->events()->createMany([
                [
                    'type' => 'akad', 'title' => $d['acara1'],
                    'starts_at' => now()->addMonths(3)->setTime(9, 0),
                    'ends_at'   => now()->addMonths(3)->setTime(11, 0),
                    'venue_name' => $d['venue1'],
                    'address'    => 'Jl. Timor Raya, Kupang, NTT',
                    'lat' => -10.1772, 'lng' => 123.6070, 'sort' => 1,
                ],
                [
                    'type' => 'resepsi', 'title' => 'Resepsi',
                    'starts_at' => now()->addMonths(3)->setTime(18, 0),
                    'ends_at'   => now()->addMonths(3)->setTime(21, 0),
                    'venue_name' => 'Ballroom Hotel, Kupang',
                    'address'    => 'Jl. Timor Raya, Kelapa Lima, Kupang, NTT',
                    'lat' => -10.1608, 'lng' => 123.6294, 'sort' => 2,
                ],
            ]);

            $inv->stories()->createMany([
                ['title' => 'Pertama Bertemu', 'date_label' => 'Maret 2021', 'sort' => 1,
                 'body' => 'Pertemuan singkat yang ternyata jadi awal dari segalanya.'],
                ['title' => 'Menjalin Kasih', 'date_label' => 'Agustus 2022', 'sort' => 2,
                 'body' => 'Memutuskan melangkah bersama menuju masa depan.'],
                ['title' => 'Lamaran', 'date_label' => 'Desember 2025', 'sort' => 3,
                 'body' => 'Mengikat janji dengan restu kedua keluarga.'],
            ]);

            $seed = $d['theme'];
            $inv->photos()->createMany(collect(range(1, 6))->map(fn ($i) => [
                'path' => "https://picsum.photos/seed/{$seed}{$i}/600/800", 'sort' => $i,
            ])->all());

            $inv->giftAccounts()->createMany([
                ['kind' => 'bank', 'label' => 'Bank BCA', 'account_number' => '1234567890',
                 'account_name' => $inv->bride_name, 'sort' => 1],
                ['kind' => 'ewallet', 'label' => 'GoPay', 'account_number' => '081234567890',
                 'account_name' => $inv->groom_name, 'sort' => 2],
            ]);
        }

        $this->command?->info('8 undangan demo siap.');
        foreach ($demos as $d) {
            $this->command?->line('  /u/' . $d['slug']);
        }
    }
}
