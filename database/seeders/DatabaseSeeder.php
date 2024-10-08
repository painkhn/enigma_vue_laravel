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
            'name' => 'Разработка игр',
            'link' => 'game_dev',
        ]);
        Category::factory()->create([
            'name' => 'Игровые новости',
            'link' => 'game_news',
        ]);
        Category::factory()->create([
            'name' => 'Блог',
            'link' => 'blog',
        ]);
    }
}
