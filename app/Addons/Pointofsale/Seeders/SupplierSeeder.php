<?php

namespace App\Addons\Pointofsale\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder as Seeder;
use App\Models\Supplier;
use IlLuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Supplier::updateOrCreate([
            'code' => Str::random(5),
            'name' => 'Supplier 1',
            'contact' => '627861766171',
            'email' => 'supplier@example.com',
            'address' => 'Jakarta'
        ]);
    }
}
