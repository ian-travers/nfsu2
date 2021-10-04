<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'commentable_type' => 'news',
            'commentable_id' => News::factory(),
            'user_id' => User::factory(),
            'parent_id' => null,
            'body' => $this->faker->sentence(),
        ];
    }
}
