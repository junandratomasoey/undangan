<?php

namespace Database\Seeders;

use App\Models\Invitation;
use Illuminate\Database\Seeder;

class DemoInvitationSeeder extends Seeder
{
    public function run(): void
    {
        $inv = Invitation::updateOrCreate(
            ['slug' => 'andi-sinta'],
            [
                'theme'        => 'sasando',
                'plan'         => 'platinum',   // show every feature in the demo
                'status'       => 'published',
                'groom_name'   => 'Andi Prasetya',
                'groom_short'  => 'Andi',
                'bride_name'   => 'Sinta Maharani',
                'bride_short'  => 'Sinta',
                'accent_color' => '#C8A04B',
                'music_url'    => null,
                'expires_at'   => now()->addMonths(6),
                'data_tambahan' => [
                    'groom_parents' => 'Bpk. Suryana & Ibu Ratna',
                    'bride_parents' => 'Bpk. Hidayat & Ibu Lestari',
                ],
            ]
        );

        // reset children for idempotent seeding
        $inv->events()->delete();
        $inv->stories()->delete();
        $inv->photos()->delete();
        $inv->giftAccounts()->delete();

        $inv->events()->createMany([
            [
                'type' => 'akad', 'title' => 'Akad Nikah',
                'starts_at' => now()->addMonths(2)->setTime(9, 0),
                'ends_at'   => now()->addMonths(2)->setTime(11, 0),
                'venue_name' => 'Masjid Raya Nurul Iman',
                'address'    => 'Jl. Timor Raya No. 12, Kupang, NTT',
                'lat' => -10.1772, 'lng' => 123.6070, 'sort' => 1,
            ],
            [
                'type' => 'resepsi', 'title' => 'Resepsi',
                'starts_at' => now()->addMonths(2)->setTime(18, 0),
                'ends_at'   => now()->addMonths(2)->setTime(21, 0),
                'venue_name' => 'Aston Kupang Ballroom',
                'address'    => 'Jl. Timor Raya, Kelapa Lima, Kupang, NTT',
                'lat' => -10.1608, 'lng' => 123.6294, 'sort' => 2,
            ],
        ]);

        $inv->stories()->createMany([
            ['title' => 'Pertama Bertemu', 'date_label' => 'Maret 2021', 'sort' => 1,
             'body' => 'Berawal dari satu kepanitiaan kampus, tak ada yang menyangka pertemuan singkat itu jadi awal segalanya.'],
            ['title' => 'Menjalin Kasih', 'date_label' => 'Agustus 2022', 'sort' => 2,
             'body' => 'Setelah setahun saling mengenal, kami memutuskan untuk melangkah bersama menuju masa depan.'],
            ['title' => 'Lamaran', 'date_label' => 'Desember 2025', 'sort' => 3,
             'body' => 'Dengan restu kedua keluarga, kami mengikat janji untuk melanjutkan ke jenjang pernikahan.'],
        ]);

        $inv->photos()->createMany([
            ['path' => 'https://picsum.photos/seed/wed1/600/800', 'sort' => 1],
            ['path' => 'https://picsum.photos/seed/wed2/600/800', 'sort' => 2],
            ['path' => 'https://picsum.photos/seed/wed3/600/800', 'sort' => 3],
            ['path' => 'https://picsum.photos/seed/wed4/600/800', 'sort' => 4],
            ['path' => 'https://picsum.photos/seed/wed5/600/800', 'sort' => 5],
            ['path' => 'https://picsum.photos/seed/wed6/600/800', 'sort' => 6],
        ]);

        $inv->giftAccounts()->createMany([
            ['kind' => 'bank', 'label' => 'Bank BCA', 'account_number' => '1234567890',
             'account_name' => 'Sinta Maharani', 'sort' => 1],
            ['kind' => 'ewallet', 'label' => 'GoPay', 'account_number' => '081234567890',
             'account_name' => 'Andi Prasetya', 'sort' => 2],
            ['kind' => 'address', 'label' => 'Kirim Hadiah', 'account_name' => 'Andi & Sinta',
             'note' => 'Jl. Timor Raya No. 12, Kupang, NTT 85228', 'sort' => 3],
        ]);

        $this->command?->info('Demo invitation ready → /u/andi-sinta?to=Nama+Tamu');
    }
}
