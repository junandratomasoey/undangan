<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rsvps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('invitation_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('guest_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->string('attendance');               // hadir|tidak_hadir|ragu
            $table->unsignedSmallInteger('headcount')->default(1);
            $table->timestamps();

            $table->index(['invitation_id', 'attendance']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rsvps');
    }
};
