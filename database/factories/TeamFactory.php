<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'clan' => strtoupper($this->faker->unique()->word()),
            'name' => $this->faker->sentence(3),
            'password' => 'password',
            'captain_id' => User::factory(),
        ];
    }
}
