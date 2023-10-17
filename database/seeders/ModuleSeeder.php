<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $module_array = [
            'Dashboard',
            'Sliders',
            'Contacts',
            'Users',
            'Categories',
            'Packages',
            'Flights',
            'Hotels',
            'System Roles',
            'System Admins',
            'Database Backup',
        ];
        foreach ($module_array as $module) {
            Module::Create([
                'module_name' => $module,
                'module_slug' => Str::slug($module),
            ]);
        }
    }
}
