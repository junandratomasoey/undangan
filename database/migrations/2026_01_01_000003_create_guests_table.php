<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Optional. Only needed when you want per-guest links with a QR check-in
 * (a platinum-tier feature). For simple "?to=Budi" personalization you
 * don't need a row here at all.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('invitation_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('token')->unique();          // goes in the share link
            $table->string('group')->nullable();        // "Keluarga", "Kantor"
            $table->unsignedSmallInteger('seats')->default(1);
            $table->boolean('checked_in')->default(false);
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
