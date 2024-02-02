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
        //
        Schema::create('transaction_purchase_credit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaction_purchase')->nullable();
            $table->string('amount')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('method_due')->default(false);
            $table->date('date_credit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::create('transaction_purchase_credit', function (Blueprint $table) {

        });
    }
};
