<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;
use Database\Seeders\ModulesAndPermissions\ClientModulesPermissionsSeeder;
use Database\Seeders\ModulesAndPermissions\CompanyModulesPermissionsSeeder;
use Database\Seeders\ModulesAndPermissions\PortalModulesPermissionsSeeder;
use Illuminate\Support\Facades\DB;

class ModulesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Module::truncate();

        $this->call([
            PortalModulesPermissionsSeeder::class,
            CompanyModulesPermissionsSeeder::class,
            ClientModulesPermissionsSeeder::class
        ]);
    }
}
