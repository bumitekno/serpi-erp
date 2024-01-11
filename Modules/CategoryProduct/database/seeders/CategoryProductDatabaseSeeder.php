<?php

namespace Modules\CategoryProduct\database\seeders;

use Illuminate\Database\Seeder;
use Modules\CategoryProduct\app\Models\CategoryProduct;


class CategoryProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);


        //insert example category 
        CategoryProduct::create([
            'name' => 'Mobile phones'
        ]);

        CategoryProduct::create([
            'name' => 'Game consoles'
        ]);

        CategoryProduct::create([
            'name' => 'Household furniture'
        ]);

        CategoryProduct::create([
            'name' => 'Home appliances'
        ]);

        CategoryProduct::create([
            'name' => 'Clothing'
        ]);

    }
}
