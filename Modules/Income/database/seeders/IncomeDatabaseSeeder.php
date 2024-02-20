<?php

namespace Modules\Income\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Income\app\Models\Income;

class IncomeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Income::create([
            'name' => 'TOP UP'
        ]);
    }
}
