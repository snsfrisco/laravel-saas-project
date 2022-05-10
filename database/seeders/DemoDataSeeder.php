<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();
        $now = now();

        // Companies

            $companies = [
                [ 'name' => 'SNS', 'created_by' => 1 , 'created_at' => $now, 'updated_at' => $now ],
                [ 'name' => 'ABC', 'created_by' => 1 , 'created_at' => $now, 'updated_at' => $now ]
            ];

            Company::insert($companies);

        // Company Admins

            $company_admin = CompanyUser::create([
                'company_id' => 1,
                'first_name' => 'SNS',
                'middle_name' => 'CA',
                'last_name' => 'One',
                'email' => 'sns_ca_1@gmail.com',
                'email_verified_at' => $now,
                'password' => bcrypt("password"),
                'remember_token' => Str::random(10),
                'active' => true,
                'created_by_id' => 1,
                'created_by_type' => 'App\\Models\PortalUser',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $company_admin->assignRole('Company Admin');

            $company_admin = CompanyUser::create([
                'company_id' => 2,
                'first_name' => 'ABC',
                'middle_name' => 'CA',
                'last_name' => 'One',
                'email' => 'abc_ca_1@gmail.com',
                'email_verified_at' => $now,
                'password' => bcrypt("password"),
                'remember_token' => Str::random(10),
                'active' => true,
                'created_by_id' => 1,
                'created_by_type' => 'App\\Models\PortalUser',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $company_admin->assignRole('Company Admin');
    }
}
