<?php

namespace Modules\Location\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Location\app\Models\Location;

class LocationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        Location::create([
            'name_location' => 'Location 1',
            'default' => 1,
        ]);
    }
}
