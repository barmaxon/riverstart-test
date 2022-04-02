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
            'name' => $this->faker->name(),
            'price' => $this->faker->biasedNumberBetween(100, 50000),
            'published' => $this->faker->boolean,
            'deleted_at' => $this->faker->numberBetween(1, 100) > 80 ? $this->faker->dateTime('yesterday') : null
        ];
    }
}
