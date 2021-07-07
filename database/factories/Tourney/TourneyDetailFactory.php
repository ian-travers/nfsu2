<?php

namespace Database\Factories\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\Tourney\TourneyDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourneyDetailFactory extends Factory
{
    protected $model = TourneyDetail::class;

    public function definition()
    {
        return [
            'racer_id' => User::factory()->racer(),
            'racer_username' => $this->faker->unique()->word(),
            'tourney_id' => Tourney::factory(),
            'pts' => 0,
            'signed_at' => now(),
        ];
    }
}
