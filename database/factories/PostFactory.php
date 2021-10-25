<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'author_id' => User::factory(),
            'title' => 'Factory created post',
            'slug' => 'factory-created-post',
            'excerpt' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'image' => null,
            'views_count' => 0,
            'published_at' => null,
        ];
    }

    public function published()
    {
        return $this->state([
            'published_at' => now()->subHours(),
        ]);
    }
}
