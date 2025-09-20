<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        $category = $this->faker->randomElement(['Cat Food', 'Dog Food', 'Supplies', 'Vitamin']);
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'category' => $category,
            'sku' => strtoupper($this->faker->bothify('???-###-####')),
            'price' => $this->faker->numberBetween(10000, 500000),
            'stock' => $this->faker->numberBetween(0, 200),
            'status' => $this->faker->randomElement(['available', 'coming-soon', 'preorder']),
            'description' => $this->faker->sentence(12),
            'image_path' => null,
        ];
    }
}
