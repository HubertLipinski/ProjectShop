<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class
        ]);

        \App\Models\Product::factory(50)
            ->create()
            ->each(fn ($product) => $product->categories()
                ->syncWithoutDetaching(
                    Category::inRandomOrder()->limit(2)->get()->modelKeys()
                )
            );
    }
}
