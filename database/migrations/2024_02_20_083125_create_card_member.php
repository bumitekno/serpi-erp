<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('card_member', function (Blueprint $table) {
            $table->id();
            $table->string('number_card')->nullable();
            $table->foreignId('id_customer')->nullable();
            $table->foreignId('id_supplier')->nullable();
            $table->string('balance')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('transaction_card_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_member')->nullable();
            $table->string('nominal')->nullable();
            $table->enum('type', ['topup', 'withdraw'])->default('topup');
            $table->dateTime('date_trans')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_member');
        Schema::dropIfExists('transaction_card_member');
    }
};
