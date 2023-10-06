<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminDashboardPermissionArray = [
            'Access Dashboard',
        ];
        $adminSystemRolePermissionArray = [
            'Role List',
            'Role Create',
            'Role Edit',
            'Role Delete',
        ];

        //Access Dashboard
        $adminDashboardModule = Module::where('module_name', 'Dashboard')->select('id')->first();
        for ($i = 0; $i < count($adminDashboardPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminDashboardModule->id,
                'permission_name' => $adminDashboardPermissionArray[$i],
                'permission_slug' => Str::slug($adminDashboardPermissionArray[$i]),
            ]);
        }
        //system roles
        $adminSystemRoleModule = Module::where('module_name', 'System Roles')->select('id')->first();
        for ($i = 0; $i < count($adminSystemRolePermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminSystemRoleModule->id,
                'permission_name' => $adminSystemRolePermissionArray[$i],
                'permission_slug' => Str::slug($adminSystemRolePermissionArray[$i]),
            ]);
        }
    }
}
