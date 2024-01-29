<?php

namespace Modules\Stock\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Stock\app\Models\Stock;
use Carbon\Carbon;

class StockDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        Stock::create([
            'id_product' => 1,
            'id_unit' => 1,
            'id_warehouse' => 1,
            'id_location' => 1,
            'qty_convert' => 1
        ]);
    }
}
