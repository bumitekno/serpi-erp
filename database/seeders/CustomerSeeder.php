<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use IlLuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Customer::create([
            'code' => Str::random(5),
            'name' => 'Customer 1',
            'contact' => '627861766171',
            'email' => 'customer@example.com',
            'address' => 'Jakarta'
        ]);
    }
}
