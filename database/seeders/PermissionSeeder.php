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
        $adminSystemAdminPermissionArray = [
            'Admin List',
            'Admin Create',
            'Admin Edit',
            'Admin View',
            'Admin Delete',
        ];
        $adminSystemBackupPermissionArray = [
            'Backup List',
            'Backup Create',
            'Backup Delete',
            'Backup Download',
        ];
        $adminSlidersPermissionArray = [
            'Slider List',
            'Slider Create',
            'Slider Edit',
            'Slider Delete',
        ];
        $adminCategoriesPermissionArray = [
            'Category List',
            'Category Create',
            'Category Edit',
            'Category Delete',
        ];
        $adminContactsPermissionArray = [
            'Contact List',
            'Contact Delete',
        ];
        $adminPackagesPermissionArray = [
            'Package List',
            'Package Create',
            'Package Edit',
            'Package View',
            'Package Delete',
        ];
        $adminHotelsPermissionArray = [
            'Hotel List',
            'Hotel Create',
            'Hotel Edit',
            'Hotel View',
            'Hotel Delete',
        ];
        $adminFlightsPermissionArray = [
            'Flight List',
            'Flight Create',
            'Flight Edit',
            'Flight Delete',
        ];
        $adminOrdersPermissionArray = [
            'Order List',
        ];
        $adminUsersPermissionArray = [
            'User List',
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
        //sliders
        $adminSlidersModule = Module::where('module_name', 'Sliders')->select('id')->first();
        for ($i = 0; $i < count($adminSlidersPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminSlidersModule->id,
                'permission_name' => $adminSlidersPermissionArray[$i],
                'permission_slug' => Str::slug($adminSlidersPermissionArray[$i]),
            ]);
        }
        //contacts
        $adminContactsModule = Module::where('module_name', 'Contacts')->select('id')->first();
        for ($i = 0; $i < count($adminContactsPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminContactsModule->id,
                'permission_name' => $adminContactsPermissionArray[$i],
                'permission_slug' => Str::slug($adminContactsPermissionArray[$i]),
            ]);
        }
        //Categories
        $adminCategoriesModule = Module::where('module_name', 'Categories')->select('id')->first();
        for ($i = 0; $i < count($adminCategoriesPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminCategoriesModule->id,
                'permission_name' => $adminCategoriesPermissionArray[$i],
                'permission_slug' => Str::slug($adminCategoriesPermissionArray[$i]),
            ]);
        }
        //Packages
        $adminPackagesModule = Module::where('module_name', 'Packages')->select('id')->first();
        for ($i = 0; $i < count($adminPackagesPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminPackagesModule->id,
                'permission_name' => $adminPackagesPermissionArray[$i],
                'permission_slug' => Str::slug($adminPackagesPermissionArray[$i]),
            ]);
        }
        //Flights
        $adminFlightsModule = Module::where('module_name', 'Flights')->select('id')->first();
        for ($i = 0; $i < count($adminFlightsPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminFlightsModule->id,
                'permission_name' => $adminFlightsPermissionArray[$i],
                'permission_slug' => Str::slug($adminFlightsPermissionArray[$i]),
            ]);
        }
        //Hotels
        $adminHotelsModule = Module::where('module_name', 'Hotels')->select('id')->first();
        for ($i = 0; $i < count($adminHotelsPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminHotelsModule->id,
                'permission_name' => $adminHotelsPermissionArray[$i],
                'permission_slug' => Str::slug($adminHotelsPermissionArray[$i]),
            ]);
        }
        //Users
        $adminUsersModule = Module::where('module_name', 'Users')->select('id')->first();
        for ($i = 0; $i < count($adminUsersPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminUsersModule->id,
                'permission_name' => $adminUsersPermissionArray[$i],
                'permission_slug' => Str::slug($adminUsersPermissionArray[$i]),
            ]);
        }
        //Order
        $adminOrdersModule = Module::where('module_name', 'Orders')->select('id')->first();
        for ($i = 0; $i < count($adminOrdersPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminOrdersModule->id,
                'permission_name' => $adminOrdersPermissionArray[$i],
                'permission_slug' => Str::slug($adminOrdersPermissionArray[$i]),
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
        //system admins
        $adminSystemAdminModule = Module::where('module_name', 'System Admins')->select('id')->first();
        for ($i = 0; $i < count($adminSystemAdminPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminSystemAdminModule->id,
                'permission_name' => $adminSystemAdminPermissionArray[$i],
                'permission_slug' => Str::slug($adminSystemAdminPermissionArray[$i]),
            ]);
        }
        //system admins
        $adminSystemBackupModule = Module::where('module_name', 'Database Backup')->select('id')->first();
        for ($i = 0; $i < count($adminSystemBackupPermissionArray); $i++) {
            Permission::Create([
                'module_id' => $adminSystemBackupModule->id,
                'permission_name' => $adminSystemBackupPermissionArray[$i],
                'permission_slug' => Str::slug($adminSystemBackupPermissionArray[$i]),
            ]);
        }
    }
}
