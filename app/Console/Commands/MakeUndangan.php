<?php

namespace App\Console\Commands;

use App\Models\Invitation;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class MakeUndangan extends Command
{
    /**
     * Contoh:
     *   php artisan make:undangan
     *   php artisan make:undangan --groom="Andi Prasetya" --bride="Sinta Maharani" --plan=platinum --publish
     *   php artisan make:undangan --groom=Juan --bride=Sandi --theme=tenun --slug=juan-sandi
     */
    protected $signature = 'make:undangan
        {--groom= : Nama lengkap mempelai pria}
        {--bride= : Nama lengkap mempelai wanita}
        {--slug= : Slug custom (default: dari nama)}
        {--theme= : Key tema (lihat config/undangan.php)}
        {--plan= : silver|gold|platinum}
        {--accent= : Warna aksen hex, mis. #C6892C}
        {--publish : Langsung publish (default: draft)}';

    protected $description = 'Buat undangan baru dengan cepat lewat CLI';

    public function handle(): int
    {
        $themes = config('undangan.themes');
        $plans  = array_keys(config('undangan.plans'));

        // --- Nama mempelai ---
        $groom = $this->option('groom') ?: text(
            label: 'Nama lengkap mempelai pria',
            required: true,
        );

        $bride = $this->option('bride') ?: text(
            label: 'Nama lengkap mempelai wanita',
            required: true,
        );

        // --- Tema ---
        $theme = $this->option('theme');
        if (! $theme) {
            $theme = $this->input->isInteractive()
                ? select(label: 'Pilih tema', options: $themes, default: config('undangan.default_theme'))
                : config('undangan.default_theme');
        }
        if (! array_key_exists($theme, $themes)) {
            $this->error("Tema '{$theme}' tidak terdaftar. Pilihan: " . implode(', ', array_keys($themes)));
            return self::FAILURE;
        }

        // --- Paket ---
        $plan = $this->option('plan');
        if (! $plan) {
            $plan = $this->input->isInteractive()
                ? select(label: 'Pilih paket', options: $plans, default: config('undangan.default_plan'))
                : config('undangan.default_plan');
        }
        if (! in_array($plan, $plans, true)) {
            $this->error("Paket '{$plan}' tidak valid. Pilihan: " . implode(', ', $plans));
            return self::FAILURE;
        }

        // --- Slug unik ---
        $slug = $this->uniqueSlug(
            $this->option('slug') ?: Str::before($groom, ' ') . '-' . Str::before($bride, ' ')
        );

        // --- Publish ---
        $publish = $this->option('publish')
            || ($this->input->isInteractive() && ! $this->option('no-interaction')
                && confirm(label: 'Langsung publish?', default: false));

        $inv = Invitation::create([
            'groom_name'   => $groom,
            'groom_short'  => Str::before($groom, ' '),
            'bride_name'   => $bride,
            'bride_short'  => Str::before($bride, ' '),
            'slug'         => $slug,
            'theme'        => $theme,
            'plan'         => $plan,
            'accent_color' => $this->option('accent') ?: '#C6892C',
            'status'       => $publish ? 'published' : 'draft',
        ]);

        // --- Ringkasan ---
        $this->newLine();
        $this->info('Undangan dibuat.');
        $this->table(
            ['Field', 'Nilai'],
            [
                ['Pasangan', "{$inv->groom_short} & {$inv->bride_short}"],
                ['Slug', $inv->slug],
                ['Tema', $themes[$inv->theme]],
                ['Paket', ucfirst($inv->plan)],
                ['Status', $inv->status],
            ]
        );

        if ($publish) {
            $this->line('  Link publik: ' . url("/u/{$inv->slug}") . '?to=Nama+Tamu');
        } else {
            $this->comment('  Masih draft. Publish lewat /admin atau tambahkan flag --publish.');
        }

        $this->line('  Kelola konten (acara, galeri, amplop): ' . url("/admin/undangan/{$inv->id}"));

        return self::SUCCESS;
    }

    /** Slug unik: tambahkan sufiks angka bila bentrok. */
    private function uniqueSlug(string $raw): string
    {
        $base = Str::slug($raw) ?: 'undangan';
        $slug = $base;
        $i = 1;

        while (Invitation::where('slug', $slug)->exists()) {
            $slug = "{$base}-" . (++$i);
        }

        return $slug;
    }
}
