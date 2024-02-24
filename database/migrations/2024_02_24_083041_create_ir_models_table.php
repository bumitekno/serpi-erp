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
        Schema::create('ir_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('technical_name', 200)->nullable()->unique();
            $table->string('model', 200)->nullable()->unique();
            $table->string('info')->nullable();
            $table->string('state')->nullable();
            $table->boolean('instalation')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ir_model_relation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('relation');
            $table->timestamps();
        });

        Schema::create('ir_module_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('exclusive')->default(true);
            $table->integer('create_uid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ir_models');
        Schema::dropIfExists('ir_model_relation');
        Schema::dropIfExists('ir_module_categories');
    }
};
