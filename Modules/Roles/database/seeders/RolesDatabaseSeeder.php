<?php

namespace Modules\Roles\database\seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles_superadmin = Role::create(['name' => 'Superadmin', 'guard_name' => 'web']);
        $permissions = Permission::all()->pluck('id')->toArray();
        $roles_superadmin->syncPermissions($permissions);
    }
}
