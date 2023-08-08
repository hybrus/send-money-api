<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_user_id')->constrained('users');
            $table->foreignId('recipient_user_id')->nullable()->constrained('users');
            $table->string('recipient_email', 64)->nullable();
            $table->foreignId('provider_id')->nullable()->constrained();
            $table->foreignId('bank_id')->nullable()->constrained();
            $table->decimal('amount', 10, 2);
            $table->decimal('sender_previous_balance', 10, 2);
            $table->decimal('recipient_previous_balance', 10, 2)->nullable();
            $table->string('type', 32);
            $table->decimal('fee', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
