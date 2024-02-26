<?php

namespace Modules\Warehouse\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Warehouse\app\Models\Warehouse;

class WarehouseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);

        Warehouse::query()->delete();

        Warehouse::create([
            'code' => '00001',
            'name' => 'Gudang 1'
        ]);

        Warehouse::create([
            'code' => '00002',
            'name' => 'Gudang 2'
        ]);

    }
}
