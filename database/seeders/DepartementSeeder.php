<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use IlLuminate\Support\Str;
use App\Models\Departement;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Departement::create([
            'code' => Str::random(5),
            'name' => 'Departement 1',
            'contact' => '627861766171',
            'email' => 'departement@example.com',
            'address' => 'Jakarta'
        ]);
    }
}
