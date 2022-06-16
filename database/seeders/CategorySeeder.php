<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate(['name' => 'Elektronika'], ['active' => true]);
        Category::updateOrCreate(['name' => 'Moda'], ['active' => true]);
        Category::updateOrCreate(['name' => 'Dom i ogród'], ['active' => true]);
        Category::updateOrCreate(['name' => 'Zdrowie i uroda'], ['active' => true]);
        Category::updateOrCreate(['name' => 'Kultura i rozrywka'], ['active' => true]);
        Category::updateOrCreate(['name' => 'Sport i turystyka'], ['active' => true]);
        Category::updateOrCreate(['name' => 'Inne'], ['active' => true]);
    }
}
