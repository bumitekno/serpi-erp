<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Permission::where('group_modules', 'master')->delete();
        Permission::where('group_modules', 'inventory')->delete();
        Permission::where('group_modules', 'purchase')->delete();
        Permission::where('group_modules', 'sales')->delete();
        Permission::where('group_modules', 'income')->delete();
        Permission::where('group_modules', 'expense')->delete();
        Permission::where('group_modules', 'report')->delete();
        Permission::where('group_modules', 'statistic')->delete();
    }
};
