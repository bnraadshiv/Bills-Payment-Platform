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
    public function definition()
    {
        return [
            //
            'product_name' => fake()->name(),
            'image' => fake()->name(),
            'status' => 'active',
            'description' => fake()->name(50),
            'apiID' => 1,

        ];
    }
}
