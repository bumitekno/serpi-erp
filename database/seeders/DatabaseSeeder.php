<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\AddonsSeeder;
use Database\Seeders\SettingAppSeeder;
use Modules\Roles\database\seeders\RolesDatabaseSeeder;
use Modules\Users\database\seeders\UsersDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddonsSeeder::class,
            SettingAppSeeder::class,
            PermissionSeeder::class,
            RolesDatabaseSeeder::class,
            UsersDatabaseSeeder::class,
        ]);
    }
}
