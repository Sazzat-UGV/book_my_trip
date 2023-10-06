<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        /*1. Create an admin role
        2. Assign all permission on it */

        $adminPermission=Permission::select('id')->get();
        Role::Create([
            'role_name'=>'Admin',
            'role_slug'=>'admin',
            'role_note'=>'admin has all permissions',
            'is_deleteable'=>false,
        ])->permissions()->sync($adminPermission->pluck('id'));

        //Create a Manager role
        Role::Create([
            'role_name' => 'Manager',
            'role_slug' => 'manager',
            'role_note' => 'manager has limited permissions',
            'is_deleteable' => true,
        ]);

        //Create a User role
        Role::Create([
            'role_name' => 'User',
            'role_slug' => 'user',
            'role_note' => 'user has no permissions',
            'is_deleteable' => true,
        ]);
    }
}
