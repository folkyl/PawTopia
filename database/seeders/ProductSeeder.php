<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create a mix of categories similar to your shop view
        $categories = [
            'Cat Food', 'Dog Food', 'Supplies', 'Vitamin'
        ];

        // Generate 40 demo products
        Product::factory()->count(40)->state(function () use ($categories) {
            return [
                'category' => fake()->randomElement($categories),
            ];
        })->create();
    }
}
