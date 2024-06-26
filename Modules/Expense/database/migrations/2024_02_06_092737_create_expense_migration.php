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

        Schema::create('expense', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('transaction_expense', function (Blueprint $table) {
            $table->id();
            $table->string('code_transaction')->nullable();
            $table->string('name_transaction')->nullable();
            $table->date('date_transaction')->nullable();
            $table->time('time_transaction')->nullable();
            $table->foreignId('id_user')->nullable();
            $table->foreignId('id_expense')->nullable();
            $table->foreignId('id_departement')->nullable();
            $table->string('amount')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('ref_trans')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense');
        Schema::dropIfExists('transaction_expense');
    }
};
