<?php

namespace Modules\Expense\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Expense\app\Models\Expense;

class ExpenseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        Expense::updateOrCreate([
            'name' => 'Withdraw'
        ]);
    }
}
