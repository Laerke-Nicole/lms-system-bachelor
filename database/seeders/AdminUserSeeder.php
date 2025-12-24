<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User 1 - from environment variables
        if (env('ADMIN1_EMAIL')) {
            User::firstOrCreate(
                ['email' => env('ADMIN1_EMAIL')],
                [
                    'first_name' => env('ADMIN1_FIRST_NAME', 'Admin'),
                    'last_name' => env('ADMIN1_LAST_NAME', 'User'),
                    'phone' => env('ADMIN1_PHONE', '00000000'),
                    'role' => 'admin',
                    'site_id' => null,
                    'password' => Hash::make(env('ADMIN1_PASSWORD', 'password')),
                ]
            );
        }

        // Admin User 2 - from environment variables
        if (env('ADMIN2_EMAIL')) {
            User::firstOrCreate(
                ['email' => env('ADMIN2_EMAIL')],
                [
                    'first_name' => env('ADMIN2_FIRST_NAME', 'Admin'),
                    'last_name' => env('ADMIN2_LAST_NAME', 'User'),
                    'phone' => env('ADMIN2_PHONE', '00000000'),
                    'role' => 'admin',
                    'site_id' => null,
                    'password' => Hash::make(env('ADMIN2_PASSWORD', 'password')),
                ]
            );
        }
    }
}
