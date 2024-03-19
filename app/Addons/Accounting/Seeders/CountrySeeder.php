<?php

namespace App\Addons\Accounting\Seeders;

use Illuminate\Database\Seeder as Seeder;
use Illuminate\Support\Facades\DB;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = base_path('App/Addons/Accounting/Seeders/Sql/country.sql');
        DB::unprepared(file_get_contents($sql));
    }
}
