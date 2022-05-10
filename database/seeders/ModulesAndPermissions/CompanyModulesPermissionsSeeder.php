<?php

namespace Database\Seeders\ModulesAndPermissions;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class CompanyModulesPermissionsSeeder extends Seeder
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
            $module=Module::Create([ 'app_level' => config('app_level.company'), 'name' => 'roles', 'module_name' => 'Roles', 'description' => 'Manage Roles at company level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'View Role',     'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Create Role',   'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Edit Role',     'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Delete Role',   'created_at' => $now, 'updated_at' => $now  ],
            ]);

        // users
            $module = Module::Create([ 'app_level' => config('app_level.company'), 'name' => 'users', 'module_name' => 'Users', 'description' => 'Manage Users at company level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'View User',     'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Create User',   'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Edit User',     'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Delete User',   'created_at' => $now, 'updated_at' => $now  ],
            ]);

        // clients
            $module = Module::Create([ 'app_level' => config('app_level.company'), 'name' => 'clients', 'module_name' => 'Clients', 'description' => 'Manage Clients at company level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'View Client',   'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Create Client', 'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Edit Client',   'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Delete Client', 'created_at' => $now, 'updated_at' => $now  ],
            ]);

        // client admins
            $module = Module::Create([ 'app_level' => config('app_level.company'), 'name' => 'client_admins', 'module_name' => 'Client Admins', 'description' => 'Manage Client Admin Users at company level.' ]);
            Permission::insert([
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'View Client Admin',     'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Create Client Admin',   'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Edit Client Admin',     'created_at' => $now, 'updated_at' => $now  ],
                [ 'module_id' => $module->id, 'guard_name' => 'company_user', 'name' => 'Delete Client Admin',   'created_at' => $now, 'updated_at' => $now  ],
            ]);
    }
}
