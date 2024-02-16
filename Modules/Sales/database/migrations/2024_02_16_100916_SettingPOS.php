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
        Schema::create('setting_pos_sales', function (Blueprint $table) {
            $table->id();
            $table->string('footprint')->nullable();
            $table->boolean('stock_minus')->default(true);
            $table->boolean('sales_multi_unit')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('setting_pos_sales');
    }
};
