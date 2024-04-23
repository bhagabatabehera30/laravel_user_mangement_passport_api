<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Artisan::call("passport:install yes yes");
        //Artisan::call("passport:client --personal AUTH API");

        $moduleKeyArr=[
            [
            'module_title' => 'App Settings',
            'module_key' => 'app_settings',
            'status' => 1,
            ],
            [
                'module_title' => 'App Modules',
                'module_key' => 'app_modules',
                'status' => 1,
            ],
            [
                'module_title' => 'Dashboard',
                'module_key' => 'dashboard',
                'status' => 1,
            ],
            [
                'module_title' => 'Users',
                'module_key' => 'user_list',
                'status' => 1,
            ]
            ];
            $appModuleArr=[];
            foreach ($moduleKeyArr as $key => $valueArr) {
                $appModule=\App\Models\Api\AppModule::create($moduleKeyArr[$key]);
                $appModuleArr[]=$appModule;
            }

            $rolesKeyArr=[
                [
                'role_name' => 'Super Admin',
                'creator_id' => NULL,
                ],
                [
                    'role_name' => 'Admin',
                    'creator_id' => NULL,
                ],
                [
                    'role_name' => 'Customer',
                    'creator_id' => NULL,
                ]
                ];
                foreach ($rolesKeyArr as $key => $valueArr) {
                    //print_r($rolesKeyArr);
                    $userRole=\App\Models\Api\UserRole::create($rolesKeyArr[$key]);
                    foreach ($appModuleArr as $key2 => $valueArr2) {
                        $uRArr=[
                         'role_id' => $userRole->id,
                         'module_id' => $appModuleArr[$key2]->id,
                         'module_key' => $appModuleArr[$key2]->module_key,
                         'is_view'=>1,
                         'is_edit'=>1,
                         'is_create'=>1,
                         'is_delete'=>1,
                         'custom_keys'=>NULL
                        ];
                        $userRoleP=\App\Models\Api\UserRolePermission::create($uRArr);
                    }
                }

                $payloadAdmin=[
                    'first_name' => 'Super',
                    'last_name' => 'Admin',
                    'user_code'=> 'superadmin',
                    'email' => 'superadmin@mailinator.com',
                    'country_code' => '91',
                    'mobile' => '9953331765',
                    'label' => 'Adminstrator',
                    'status' => 1,
                    'primary_role_id'=>1,
                    'creator_id' => null,
                    'secondary_roles' => null,
                    'email_verified_at' => now(),
                    'password' => Hash::make('99999999'), // password
                    'remember_token' => Str::random(10),
                ];
                \App\Models\User::create($payloadAdmin);
            

       // \App\Models\Api\AppModule::User::create($moduleKeyArr);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
