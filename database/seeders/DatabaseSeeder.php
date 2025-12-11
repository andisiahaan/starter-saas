<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. App Settings (first, needed by other components)
            SettingsSeeder::class,

            // 2. Default Users
            UserSeeder::class,

            // 3. Roles & Permissions (after users, assigns roles)
            PermissionSeeder::class,

            // 4. Legal Pages
            PagesSeeder::class,

            // 5. Product Categories
            ProductCategorySeeder::class,

            // 6. Sample Products
            ProductSeeder::class,

            // 7. Payment Methods
            PaymentMethodSeeder::class,
        ]);
    }
}
