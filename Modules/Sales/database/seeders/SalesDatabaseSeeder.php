<?php

namespace Modules\Sales\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Sales\app\Models\SettingPos;

class SalesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        SettingPos::updateOrCreate([
            'footprint' => 'Thank You ',
            'stock_minus' => true,
            'sales_multi_unit' => true
        ]);
    }
}
