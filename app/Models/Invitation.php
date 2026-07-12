<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitation extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'data_tambahan' => 'array',
        'expires_at'    => 'datetime',
    ];

    /** Resolve public route by slug instead of UUID. */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    /** Feature gate driven by config/undangan.php plans map. */
    public function hasFeature(string $feature): bool
    {
        $features = config("undangan.plans.{$this->plan}.features", []);

        return in_array($feature, $features, true);
    }

    // ---- Relations -------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class)->orderBy('sort')->orderBy('starts_at');
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function rsvps(): HasMany
    {
        return $this->hasMany(Rsvp::class)->latest();
    }

    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class)->where('is_hidden', false)->latest();
    }

    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('sort');
    }

    public function giftAccounts(): HasMany
    {
        return $this->hasMany(GiftAccount::class)->orderBy('sort');
    }

    public function stories(): HasMany
    {
        return $this->hasMany(LoveStory::class)->orderBy('sort');
    }

    // ---- Convenience accessors ------------------------------------------

    public function getMainEventAttribute(): ?Event
    {
        return $this->events->firstWhere('type', 'resepsi') ?? $this->events->first();
    }
}
