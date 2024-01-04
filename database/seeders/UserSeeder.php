<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;
use Orchid\Platform\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->roles()->attach(Role::where('slug', 'administrator')->first()->id);

        $user = User::create([
            'name' => 'Moderator',
            'email' => 'moderator@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->roles()->attach(Role::where('slug', 'moderator')->first()->id);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->roles()->attach(Role::where('slug', 'user')->first()->id);
    }
}
