<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Root "tenant" table. One invitation = one order/couple.
 * Single database, resolved by slug on the public route.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Owner. Nullable so a "done-for-you" invitation can exist
            // before (or without) the couple ever logging in.
            $table->foreignUuid('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('slug')->unique();            // andi-sinta
            $table->string('theme')->default('sasando'); // key in config/undangan.php
            $table->string('plan')->default('gold');     // silver|gold|platinum
            $table->string('status')->default('draft');  // draft|published|expired

            // Couple (kept on the root row so the cover renders with one query)
            $table->string('groom_name');
            $table->string('groom_short')->nullable();   // "Andi"
            $table->string('bride_name');
            $table->string('bride_short')->nullable();   // "Sinta"

            // Presentation
            $table->string('accent_color')->default('#C8A04B');
            $table->string('cover_photo')->nullable();
            $table->string('music_url')->nullable();

            // Free-form extras so you never migrate for a one-off field again.
            $table->json('data_tambahan')->nullable();

            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'expires_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
