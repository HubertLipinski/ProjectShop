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
        $min = 5;
        $max = 3500;

        return [
            'title' => $this->faker->sentence(4, true),
            'description' => $this->faker->realText,
            'price' => mt_rand($min * 10, $max * 10) / 10,
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
