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

        // User::factory()->create([
        //     'name' => 'dima',
        //     'email' => 'dima@mail.ru', 
        //     'age' => 20, 
        //     'password' => '123123123',
        // ]);

        // Theme::factory()->create([
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'name' => 'example title',
        //     'content' => 'example content',
        // ]);
    }
}
