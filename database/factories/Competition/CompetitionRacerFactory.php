<?php

namespace Database\Factories\Competition;

use App\Models\Competition\Competition;
use App\Models\Competition\CompetitionRacer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionRacerFactory extends Factory
{
    protected $model = CompetitionRacer::class;

    public function definition()
    {
        /** @var User $user */
        $user = User::factory()->create();

        return [
            'competition_id' => Competition::factory(),
            'username' => $user->username,
            'place' => '1',
            'car' => 'Mazda RX-7',
            'result' => '18.88',
            'pts' => '200',
        ];
    }
}
