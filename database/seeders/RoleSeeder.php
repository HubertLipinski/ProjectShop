<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;
use Orchid\Support\Facades\Dashboard;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'slug' => 'administrator',
            'name' => 'Administrator',
            'permissions' => Dashboard::getAllowAllPermission()
        ]);

        Role::create([
            'slug' => 'moderator',
            'name' => 'Moderator',
            'permissions' => Dashboard::getAllowAllPermission([
                __('Product'),
                __('Category'),
            ])
                ->merge([
                    'platform.index' => true,
                    'platform.systems.products' => true,
                    'platform.systems.categories' => true,
                ])
        ]);

        Role::create([
            'slug' => 'user',
            'name' => 'Użytkownik',
            'permissions' => []
        ]);
    }
}
