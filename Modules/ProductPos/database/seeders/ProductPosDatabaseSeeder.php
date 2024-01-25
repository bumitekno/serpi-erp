<?php

namespace Modules\ProductPos\database\seeders;

use Illuminate\Database\Seeder;
use Modules\ProductPos\app\Models\ProductPos;

class ProductPosDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        for ($i = 1; $i <= 100; $i++) {
            ProductPos::create([
                'code_product' => '11231' . $i,
                'name' => 'Product ' . $i,
                'category' => 1,
                'price_sell' => $i . '000' + 5000,
                'price_purchase' => $i . '000',
                'description' => 'Product ' . $i,
                'stock_last' => 100
            ]);
        }
    }
}
