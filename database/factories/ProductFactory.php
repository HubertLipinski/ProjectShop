<?php

namespace Database\Factories;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private const PLACEHOLDERS = [
        '150.png',
        '300.png',
        '640x320.png',
        '1920x1080.png',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $min = 1;
        $max = 100;

        $size = $this->faker->randomElement(self::PLACEHOLDERS);

        $thumbnail = env('APP_URL') . '/storage/placeholder/product/' . $size;
        if (env('APP_ENV') !== 'local') {
            $thumbnail = Storage::disk('s3')->url('placeholder/' . $this->faker->randomElement(self::PLACEHOLDERS));
        }

        return [
            'title' => $this->faker->sentence(4, true),
            'description' => $this->faker->realText(80, true),
            'content' => $this->faker->realText(500),
            'price' => mt_rand($min * 10, $max * 10) / 10,
            'thumbnail' => $thumbnail,
            'status' => $this->faker->randomElement(Status::availableValues()),
        ];
    }
}
