<?php

namespace Database\Seeders;

use App\Models\{Theme, Category, User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Category::factory()->create([
            'name' => 'Разработка игр'
        ]);
        Category::factory()->create([
            'name' => 'Игровые новости',
        ]);
        Category::factory()->create([
            'name' => 'Блог',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'root@gmail.com',
            'age' => 20,
            'password' => 'adminpassword',
            'is_admin' => 1,
            'created_at' => '2024-12-01 12:51:41'
        ]);
        User::factory()->create([
            'name' => 'dima',
            'email' => 'dima@gmail.com',
            'age' => 15,
            'password' => '123123123',
            'is_admin' => 0,
            'created_at' => '2024-11-29 12:51:41'
        ]);
        User::factory()->create([
            'name' => 'sasha',
            'email' => 'sasha@gmail.com',
            'age' => 16,
            'password' => '123123123',
            'is_admin' => 0,
            'is_ban' => 1,
            'created_at' => '2024-11-29 12:51:41'
        ]);
        User::factory()->create([
            'name' => 'andrey',
            'email' => 'andrey@gmail.com',
            'age' => 21,
            'password' => '123123123',
            'is_admin' => 0,
            'created_at' => '2024-11-28 12:51:41'
        ]);
        User::factory()->create([
            'name' => 'denis',
            'email' => 'den@gmail.com',
            'age' => 19,
            'password' => '123123123',
            'is_admin' => 0,
            'is_ban' => 1,
            'created_at' => '2024-11-27 12:51:41'
        ]);
    }
}
