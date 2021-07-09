<?php

namespace Database\Factories\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\Tourney\TourneyRacer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourneyRacerFactory extends Factory
{
    protected $model = TourneyRacer::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->racer(),
            'racer_username' => $this->faker->unique()->word(),
            'tourney_id' => Tourney::factory(),
            'pts' => 0,
            'signed_at' => now(),
        ];
    }
}
