<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder utama. Sengaja TIDAK memakai User::factory() (butuh Faker,
 * yang tidak terpasang saat composer install --no-dev di server),
 * sehingga `php artisan migrate --seed` aman di produksi.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            // DemoThemesSeeder::class,  // aktifkan bila ingin 4 undangan demo untuk etalase
        ]);
    }
}
