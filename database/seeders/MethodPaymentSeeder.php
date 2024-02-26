<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MethodPayment;

class MethodPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MethodPayment::truncate();
        MethodPayment::create([
            'name' => 'Cash'
        ]);

        MethodPayment::create([
            'name' => 'Transfer Bank'
        ]);

        MethodPayment::create([
            'name' => 'Due'
        ]);

        MethodPayment::create([
            'name' => 'E-wallet'
        ]);

        MethodPayment::create([
            'name' => 'Card Member'
        ]);
    }
}
