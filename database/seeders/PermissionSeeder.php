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

        //Access Dashboard
        $adminDashboardModule = Module::where('module_name', 'Admin Dashboard')->select('id')->first();
        for ($i = 0; $i < count($adminDashboardPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminDashboardModule->id,
                'permission_name' => $adminDashboardPermissionArray[$i],
                'permission_slug' => Str::slug($adminDashboardPermissionArray[$i]),
            ]);
        }
    }
}
