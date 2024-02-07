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
        Schema::create('transaction_purchase', function (Blueprint $table) {
            $table->id();
            $table->string('code_transaction')->nullable();
            $table->date('date_purchase')->nullable();
            $table->time('time_purchase')->nullable();
            $table->boolean('status')->default(false);
            $table->date('date_due')->nullable();
            $table->string('amount')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('tax_percent')->nullable();
            $table->string('discount_persent')->nullable();
            $table->string('discount_amount')->nullable();
            $table->foreignId('id_supplier')->nullable();
            $table->foreignId('id_departement')->nullable();
            $table->foreignId('id_user')->nullable();
            $table->foreignId('id_method_payment')->nullable();
            $table->text('note')->nullable();
            $table->string('adjustment_amount')->nullable();
            $table->timestamps();
        });

        // Detail Transaction 
        Schema::create('transaction_item_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaction_purchase')->nullable();
            $table->foreignId('id_product')->nullable();
            $table->foreignId('id_unit')->nullable();
            $table->string('qty')->nullable();
            $table->string('price_purchase')->nullable();
            $table->string('price_purchase_before')->nullable();
            $table->string('tax_amount_item')->nullable();
            $table->string('tax_percent_item')->nullable();
            $table->string('discount_persent_item')->nullable();
            $table->string('discount_amount_item')->nullable();
            $table->text('note_item')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('transaction_purchase');
        Schema::dropIfExists('transaction_item_purchase');
    }
};
