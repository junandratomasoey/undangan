<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gift_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('invitation_id')->constrained()->cascadeOnDelete();

            $table->string('kind')->default('bank');   // bank|ewallet|qris|address
            $table->string('label');                   // "BCA", "GoPay", "QRIS"
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('qris_image')->nullable();  // path to QRIS PNG
            $table->text('note')->nullable();          // used for physical gift address
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_accounts');
    }
};
