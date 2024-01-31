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
        Schema::table('transaction_item_sales', function (Blueprint $table) {
            $table->string('qty_convert')->nullable();
            $table->boolean('check_convert')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_item_sales', function (Blueprint $table) {

        });
    }
};
