<?php

namespace App\Addons\Accounting\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder as Seeder;

use App\Addons\Accounting\Seeders\AccountSeeder;
use App\Addons\Accounting\Seeders\AccountTypeSeeder;
use App\Addons\Accounting\Seeders\CompanySeeder;
use App\Addons\Accounting\Seeders\CurrencySeeder;
use App\Addons\Accounting\Seeders\CountrySeeder;
use App\Addons\Accounting\Seeders\CountryStateSeeder;

class AccountingInstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->call([
            CompanySeeder::class,
            AccountSeeder::class,
            AccountTypeSeeder::class,
            CurrencySeeder::class,
            CountrySeeder::class,
            CountryStateSeeder::class
        ]);
    }
}
