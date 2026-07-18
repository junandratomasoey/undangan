<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        $invitations = Invitation::query()
            ->when($request->q, fn ($q) => $q->where(fn ($w) =>
                $w->where('groom_name', 'like', "%{$request->q}%")
                  ->orWhere('bride_name', 'like', "%{$request->q}%")
                  ->orWhere('slug', 'like', "%{$request->q}%")))
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->withCount(['rsvps', 'wishes'])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.invitations.index', compact('invitations'));
    }

    public function create()
    {
        return view('admin.invitations.create', [
            'themes' => config('undangan.themes'),
            'plans'  => config('undangan.plans'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['groom_short'], $data['bride_short']);
        $data['data_tambahan'] = [
            'groom_parents' => $request->groom_parents,
            'bride_parents' => $request->bride_parents,
        ];

        $inv = Invitation::create($data);

        return redirect()
            ->route('admin.invitations.edit', $inv)
            ->with('ok', 'Undangan dibuat. Lengkapi acara, galeri, dan amplop.');
    }

    public function edit(Invitation $invitation)
    {
        $invitation->load(['events', 'stories', 'photos', 'giftAccounts']);

        return view('admin.invitations.edit', [
            'inv'    => $invitation,
            'themes' => config('undangan.themes'),
            'plans'  => config('undangan.plans'),
        ]);
    }

    public function update(Request $request, Invitation $invitation)
    {
        $data = $this->validateData($request, $invitation);
        $data['slug'] = $this->uniqueSlug($data['slug'], $data['groom_short'], $data['bride_short'], $invitation);
        $data['data_tambahan'] = array_merge($invitation->data_tambahan ?? [], [
            'groom_parents' => $request->groom_parents,
            'bride_parents' => $request->bride_parents,
        ]);

        // Upload musik baru — hapus file lama dulu (kalau ada & bukan URL eksternal).
        if ($request->hasFile('music_file')) {
            $this->deleteMusicFile($invitation);
            $data['music_url'] = $request->file('music_file')
                ->store("invitations/{$invitation->id}/music", 'public');
            $data['music_url'] = \Storage::url($data['music_url']);
        }
        // 'music_file' cuma dipakai untuk proses upload di atas — bukan kolom
        // di tabel invitations, jadi harus dibuang sebelum update() dipanggil.
        unset($data['music_file']);

        $invitation->update($data);

        return back()->with('ok', 'Perubahan tersimpan.');
    }

    /** Hapus musik yang sedang terpasang (tombol "Hapus Musik" di form). */
    public function removeMusic(Invitation $invitation)
    {
        $this->deleteMusicFile($invitation);
        $invitation->update(['music_url' => null]);

        return back()->with('ok', 'Musik dihapus.');
    }

    public function togglePublish(Invitation $invitation)
    {
        $invitation->update([
            'status' => $invitation->status === 'published' ? 'draft' : 'published',
        ]);

        return back()->with('ok', $invitation->status === 'published'
            ? 'Undangan sekarang tayang (published).'
            : 'Undangan disembunyikan (draft).');
    }

    public function destroy(Invitation $invitation)
    {
        $invitation->delete(); // cascade menghapus semua tabel anak

        return redirect()
            ->route('admin.invitations.index')
            ->with('ok', 'Undangan dihapus.');
    }

    // ---- helpers ---------------------------------------------------------

    private function validateData(Request $request, ?Invitation $inv = null): array
    {
        return $request->validate([
            'groom_name'   => ['required', 'string', 'max:120'],
            'groom_short'  => ['nullable', 'string', 'max:40'],
            'bride_name'   => ['required', 'string', 'max:120'],
            'bride_short'  => ['nullable', 'string', 'max:40'],
            'slug'         => ['nullable', 'string', 'max:120', 'alpha_dash',
                                Rule::unique('invitations', 'slug')->ignore($inv?->id)],
            'theme'        => ['required', Rule::in(array_keys(config('undangan.themes')))],
            'plan'         => ['required', Rule::in(array_keys(config('undangan.plans')))],
            'accent_color' => ['required', 'string', 'max:9'],
            'music_file'   => ['nullable', 'file', 'mimes:mp3,mpga,wav,ogg,m4a', 'max:8192'], // maks 8MB
            'expires_at'   => ['nullable', 'date'],
        ]);
    }

    /** Hapus file musik lama dari storage, kalau memang file lokal (bukan URL eksternal). */
    private function deleteMusicFile(Invitation $invitation): void
    {
        if (! $invitation->music_url) {
            return;
        }

        $prefix = \Storage::url('');
        if (str_starts_with($invitation->music_url, $prefix)) {
            $path = ltrim(substr($invitation->music_url, strlen($prefix)), '/');
            \Storage::disk('public')->delete($path);
        }
    }

    private function uniqueSlug(?string $slug, ?string $groom, ?string $bride, ?Invitation $inv = null): string
    {
        $base = Str::slug($slug ?: trim("{$groom}-{$bride}", '-') ?: 'undangan');
        $candidate = $base;
        $i = 1;

        while (Invitation::where('slug', $candidate)
            ->when($inv, fn ($q) => $q->where('id', '!=', $inv->id))
            ->exists()) {
            $candidate = "{$base}-" . (++$i);
        }

        return $candidate;
    }
}
