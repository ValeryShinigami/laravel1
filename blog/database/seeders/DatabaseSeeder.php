<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // \App\Models\User::factory(10)->create(); //10 le nombre de user 
        \App\Models\Category::factory(3)->create(); //50 le nombre de catégory

        $admin = User::create([
            'name' => 'vk',
            'email' => 'vk@gmail.com',
            'password' => Hash::make('vk@gmail.com'),
            'role' => 'admin'
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user@gmail.com'),
            'role' => 'user'
        ]);

        

    }
}
