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
        Schema::create('bank_provider', function (Blueprint $table) {
            $table->foreignId('provider_id')->constrained();
            $table->foreignId('bank_id')->constrained();
            $table->primary(['provider_id', 'bank_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
