<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('invitation_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->text('message');
            $table->boolean('is_hidden')->default(false); // moderation from dashboard
            $table->timestamps();

            $table->index(['invitation_id', 'is_hidden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishes');
    }
};
