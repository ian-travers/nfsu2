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
        /** @var \App\Models\User $racer */
        $racer = User::factory()->racer()->create();

        return [
            'user_id' => $racer->id,
            'racer_username' => $racer->username,
            'tourney_id' => Tourney::factory(),
            'pts' => 0,
            'signed_at' => now(),
        ];
    }
}
