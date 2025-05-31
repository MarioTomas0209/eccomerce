<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => fake()->unique()->numerify('####'),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 10, 100),
            'image_path' => 'products/' . fake()->image(storage_path('app/public/products'), 640, 480, null, false),
            'subcategory_id' => fake()->numberBetween(1, 632),
        ];
    }
}
