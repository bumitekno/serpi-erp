<?php

namespace Modules\Users\database\seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        app()['cache']->forget('spatie.permission.cache');

        $superadmin = User::firstOrCreate(
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@serpi.id'
            ],
            [
                'password' => Hash::make('12345678')
            ]
        );

        $superadmin->assignRole('Superadmin');

    }
}
