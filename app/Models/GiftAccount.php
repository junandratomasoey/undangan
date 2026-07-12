<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiftAccount extends Model
{
    use HasUuids;

    protected $guarded = [];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
