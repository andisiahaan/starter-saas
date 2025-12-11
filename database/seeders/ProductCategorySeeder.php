<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Credits Pack',
                'slug' => 'credits-pack',
                'description' => 'Standard credit packages for regular use',
                'is_active' => true,
            ],
            [
                'name' => 'Premium Credits',
                'slug' => 'premium-credits',
                'description' => 'Premium credit packages with bonus credits',
                'is_active' => true,
            ],
            [
                'name' => 'Special Offers',
                'slug' => 'special-offers',
                'description' => 'Limited time special offers and promotions',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
