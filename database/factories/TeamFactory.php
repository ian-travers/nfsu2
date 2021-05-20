<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'clan' => strtoupper(Str::random(4)),
            'name' => $this->faker->sentence(3),
            'password' => 'password',
            'captain_id' => User::factory(),
        ];
    }
}
