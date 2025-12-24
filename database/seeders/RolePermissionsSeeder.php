<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $superAdmin = Role::firstOrCreate(['name' => 'superAdmin', 'guard_name' => 'web']);

        $permissions = [
            'create car',
            'edit car',
            'delete car',
            'show car',
            'create center',
            'edit center',
            'delete center',
            'show center'
        ];

        foreach ($permissions as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
        }

        $admin->syncPermissions([
            'create car',
            'edit car',
            'delete car',
            'create center',
            'edit center',
            'delete center'
        ]);

        $superAdmin->givePermissionTo(Permission::all());

    }
}
