<?php

namespace Database\Seeders;

use App\Models\PortalUser;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PortalSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PortalUser::truncate();
        Role::truncate();
        $user = PortalUser::updateOrCreate(
            ['email' => 'super_admin@gmail.com'],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10)
            ]
        );
        $role = Role::create(['name' => 'Portal Admin', 'guard_name' => 'portal_user']);
        $user->assignRole($role);

        Role::create(['name' => 'Company Admin', 'guard_name' => 'company_user']);
        Role::create(['name' => 'Client Admin', 'guard_name' => 'client_user']);
    }
}
