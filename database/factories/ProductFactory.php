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
            //
            'name' => fake()->name(),
            'description' => fake()->paragraph(2),
            'price' => '39.99',
            'path' => fake()->imageUrl(100, 120),
            'slug' => fake()->slug(3),
            'stripe_product_id' => rand(),
            'stripe_price_id' => rand(),

        ];
    }
}
