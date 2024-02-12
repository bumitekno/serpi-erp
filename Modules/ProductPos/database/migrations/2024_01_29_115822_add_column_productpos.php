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
        Schema::table('product_pos', function (Blueprint $table) {
            $table->string('stock_min')->nullable();
            $table->string('stock_max')->nullable();
            $table->date('date_expired')->nullable();
            $table->boolean('sold_out')->default(false);
            $table->boolean('enabled')->default(true);
            $table->foreignId('id_warehouse')->nullable();
            $table->foreignId('id_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_pos', function (Blueprint $table) {

        });
    }
};
