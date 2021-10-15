<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'likeable_type' => 'news',
            'likeable_id' => News::factory(),
            'user_id' => User::factory(),
            'type_id' => Like::LIKE,
        ];
    }
}
