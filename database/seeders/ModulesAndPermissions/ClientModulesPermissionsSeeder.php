<?php

namespace Database\Seeders\ModulesAndPermissions;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class ClientModulesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        // roles
            $module=Module::Create([ 'app_level' => config('app_level.client'), 'name' => 'roles', 'module_name' => 'Roles', 'description' => 'Manage Roles at client level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'View Role',    'created_at' => $now, 'updated_at' => $now ],
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'Create Role',  'created_at' => $now, 'updated_at' => $now ],
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'Edit Role',    'created_at' => $now, 'updated_at' => $now ],
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'Delete Role',  'created_at' => $now, 'updated_at' => $now ],
            ]);

        // users
            $module = Module::Create([ 'app_level' => config('app_level.client'), 'name' => 'users', 'module_name' => 'Users', 'description' => 'Manage Users at client level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'View User',    'created_at' => $now, 'updated_at' => $now ],
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'Create User',  'created_at' => $now, 'updated_at' => $now ],
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'Edit User',    'created_at' => $now, 'updated_at' => $now ],
                [ 'module_id' => $module->id, 'guard_name' => 'client_user', 'name' => 'Delete User',  'created_at' => $now, 'updated_at' => $now ],
            ]);


    }
}
