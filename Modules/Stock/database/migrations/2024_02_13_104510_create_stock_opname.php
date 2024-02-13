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
        Schema::create('stock_opname_trans', function (Blueprint $table) {
            $table->id();
            $table->date('date_opname')->nullable();
            $table->foreignId('id_warehouse')->nullable();
            $table->foreignId('id_location')->nullable();
            $table->foreignId('id_product')->nullable();
            $table->foreignId('id_unit')->nullable();
            $table->string('stock_before')->nullable();
            $table->string('stock_after')->nullable();
            $table->string('difference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_opname_trans');
    }
};
