<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin (ID 1)
        User::firstOrCreate(
            ['id' => 1],
            [
                'email' => 'superadmin@domain.com',
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'referral_code' => 'SUPERADMIN',
                'password' => Hash::make('superadmin'),
                'email_verified_at' => Carbon::now(),
            ]
        );

        // Admin User (ID 2)
        User::firstOrCreate(
            ['id' => 2],
            [
                'email' => 'admin@domain.com',
                'name' => 'Admin User',
                'username' => 'admin',
                'referral_code' => 'ADMIN2025',
                'password' => Hash::make('admin'),
                'email_verified_at' => Carbon::now(),
            ]
        );

        // User (ID 3)
        User::firstOrCreate(
            ['id' => 3],
            [
                'email' => 'user@domain.com',
                'name' => 'User',
                'username' => 'user',
                'referral_code' => 'USER2025X',
                'password' => Hash::make('user'),
                'email_verified_at' => Carbon::now(),
            ]
        );

        // Demo User (ID 4)
        User::firstOrCreate(
            ['id' => 4],
            [
                'email' => 'demo@domain.com',
                'name' => 'Demo User',
                'username' => 'demo',
                'referral_code' => 'DEMO2025X',
                'password' => Hash::make('demo'),
                'email_verified_at' => Carbon::now(),
            ]
        );
    }
}
