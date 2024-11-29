<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Theme, Category, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ThemeCreateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_a_theme()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->postJson('/theme/new', [
            'title' => 'Test Theme Title',
            'content' => 'Test Theme Content',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['redirect' => '/']);

        $this->assertDatabaseHas('themes', [
            'name' => 'Test Theme Title',
            'content' => 'Test Theme Content',
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
    }
}
