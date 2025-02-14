<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 50000, 500000),
            'bedrooms' => fake()->numberBetween(1, 10),
            'bathrooms' => fake()->numberBetween(1, 10),
            'storeys' => fake()->numberBetween(1, 10),
            'garages' => fake()->numberBetween(1, 10),
        ];
    }
}
