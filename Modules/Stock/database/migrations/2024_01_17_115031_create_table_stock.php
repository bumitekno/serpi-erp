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
        Schema::create('stock_unit_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_product')->nullable();
            $table->foreignId('id_unit')->nullable();
            $table->foreignId('id_warehouse')->nullable();
            $table->foreignId('id_location')->nullable();
            $table->string('stock_min')->nullable();
            $table->string('stock_max')->nullable();
            $table->string('qty_convert')->nullable();
            $table->date('date_expired')->nullable();
            $table->boolean('sold_out')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_unit_product');
    }
};
