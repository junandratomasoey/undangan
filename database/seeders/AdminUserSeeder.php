<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder akun admin — TANPA Faker, aman untuk produksi (--no-dev).
 *
 * Kredensial diambil dari .env agar tidak ada password ter-commit ke repo:
 *   ADMIN_NAME="Admin"
 *   ADMIN_EMAIL="admin@nttdigital.com"
 *   ADMIN_PASSWORD="PasswordKuatMu"
 *
 * Jalankan:
 *   php artisan db:seed --class=Database\\Seeders\\AdminUserSeeder
 *
 * Idempoten: kalau email sudah ada, datanya diperbarui (bukan duplikat).
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email    = env('ADMIN_EMAIL', 'admin@nttdigital.com');
        $name     = env('ADMIN_NAME', 'Admin');
        $password = env('ADMIN_PASSWORD');

        if (blank($password)) {
            $this->command?->error('ADMIN_PASSWORD belum diisi di .env. Seeder dibatalkan.');
            $this->command?->line('Tambahkan di .env, contoh:');
            $this->command?->line('  ADMIN_NAME="Admin"');
            $this->command?->line('  ADMIN_EMAIL="admin@nttdigital.com"');
            $this->command?->line('  ADMIN_PASSWORD="PasswordKuatMu"');
            $this->command?->line('Lalu: php artisan config:clear');

            return;
        }

        if (strlen($password) < 8) {
            $this->command?->error('ADMIN_PASSWORD terlalu pendek (minimal 8 karakter). Seeder dibatalkan.');

            return;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name'              => $name,
                'password'          => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        $this->command?->newLine();
        $this->command?->info($user->wasRecentlyCreated ? 'Akun admin dibuat.' : 'Akun admin diperbarui.');
        $this->command?->table(
            ['Field', 'Nilai'],
            [
                ['Nama', $user->name],
                ['Email', $user->email],
                ['Password', str_repeat('*', strlen($password)) . '  (dari .env)'],
            ]
        );
        $this->command?->comment('  Login di: ' . url('/login'));
    }
}
