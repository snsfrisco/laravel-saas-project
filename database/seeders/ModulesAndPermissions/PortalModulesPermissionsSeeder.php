<?php

namespace Database\Seeders\ModulesAndPermissions;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class PortalModulesPermissionsSeeder extends Seeder
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
            $module=Module::Create([ 'app_level' => config('app_level.portal'), 'name' => 'roles', 'module_name' => 'Roles', 'description' => 'Manage Roles at portal level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'View Role',    'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Create Role',  'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Edit Role',    'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Delete Role',  'created_at' => $now, 'updated_at' => $now   ],
            ]);

        // users
            $module = Module::Create([ 'app_level' => config('app_level.portal'), 'name' => 'users', 'module_name' => 'Users', 'description' => 'Manage Users at portal level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'View User',    'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Create User',  'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Edit User',    'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Delete User',  'created_at' => $now, 'updated_at' => $now   ],
            ]);

        // companies
            $module = Module::Create([ 'app_level' => config('app_level.portal'), 'name' => 'companies', 'module_name' => 'Companies', 'description' => 'Manage Companies at portal level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'View Company',     'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Create Company',   'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Edit Company',     'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Delete Company',   'created_at' => $now, 'updated_at' => $now   ],
            ]);

        // companies admins
            $module = Module::Create([ 'app_level' => config('app_level.portal'), 'name' => 'company_admins', 'module_name' => 'Company Admins', 'description' => 'Manage Company Admin Users at portal level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'View Company Admin',   'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Create Company Admin', 'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Edit Company Admin',   'created_at' => $now, 'updated_at' => $now   ],
                [ 'module_id' => $module->id, 'guard_name' => 'portal_user', 'name' => 'Delete Company Admin', 'created_at' => $now, 'updated_at' => $now   ],
            ]);
    }
}
