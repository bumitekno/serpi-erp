<?php

namespace Modules\UnitProduct\database\seeders;

use Illuminate\Database\Seeder;
use Modules\UnitProduct\app\Models\UnitProduct;

class UnitProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        UnitProduct::create([
            'name' => 'Pcs'
        ]);

        UnitProduct::create([
            'name' => 'Dus'
        ]);

        UnitProduct::create([
            'name' => 'Pak'
        ]);

        UnitProduct::create([
            'name' => 'Bal'
        ]);

        UnitProduct::create([
            'name' => 'kg'
        ]);

        UnitProduct::create([
            'name' => 'Liter'
        ]);
    }
}
