<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create default category
        $defaultCategory = ProductCategory::firstOrCreate(
            ['slug' => 'credits-pack'],
            [
                'name' => 'Credits Pack',
                'description' => 'Standard credit packages',
                'is_active' => true,
            ]
        );

        $products = [
            [
                'name' => 'Basic Credits',
                'description' => 'Perfect for getting started. Includes 100 credits.',
                'category_id' => $defaultCategory->id,
                'price' => 10000,
                'credit_amount' => 100,
                'bonus_credit' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Standard Credits',
                'description' => 'Most popular choice. Includes 500 credits with 10% bonus.',
                'category_id' => $defaultCategory->id,
                'price' => 45000,
                'credit_amount' => 500,
                'bonus_credit' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Credits',
                'description' => 'Best value. Includes 1000 credits with 15% bonus.',
                'category_id' => $defaultCategory->id,
                'price' => 85000,
                'credit_amount' => 1000,
                'bonus_credit' => 150,
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise Credits',
                'description' => 'For power users. Includes 5000 credits with 20% bonus.',
                'category_id' => $defaultCategory->id,
                'price' => 400000,
                'credit_amount' => 5000,
                'bonus_credit' => 1000,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
