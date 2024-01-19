<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        Supplier::create([
            'code' => Str::random(5),
            'name' => 'Supplier 1',
            'contact' => '627861766171',
            'email' => 'supplier@example.com',
            'address' => 'Jakarta'
        ]);
    }
}
