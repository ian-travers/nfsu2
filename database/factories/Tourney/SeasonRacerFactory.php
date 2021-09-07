<?php

namespace Database\Factories\Tourney;

use App\Models\Tourney\SeasonRacer;
use App\Models\User;
use App\Settings\SeasonSettings;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonRacerFactory extends Factory
{
    protected $model = SeasonRacer::class;

    public function definition()
    {
        /** @var User $user */
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'racer_username' => $user->username,
            'season_index' => app(SeasonSettings::class)->index,
        ];
    }

    public function firstTourneys()
    {
        return $this->state([
            'circuit_pts' => 100,
            'sprint_pts' => 100,
            'drag_pts' => 100,
            'drift_pts' => 100,
        ]);
    }

    public function secondTourneys()
    {
        return $this->state([
            'circuit_pts' => 80,
            'sprint_pts' => 80,
            'drag_pts' => 80,
            'drift_pts' => 80,
        ]);
    }

    public function thirdTourneys()
    {
        return $this->state([
            'circuit_pts' => 60,
            'sprint_pts' => 60,
            'drag_pts' => 60,
            'drift_pts' => 60,
        ]);
    }

    public function firstCompetitions()
    {
        return $this->state([
            'competition_count' => 1,
            'competition_pts' => 1000,
        ]);
    }

    public function secondCompetitions()
    {
        return $this->state([
            'competition_count' => 1,
            'competition_pts' => 800,
        ]);
    }

    public function thirdCompetitions()
    {
        return $this->state([
            'competition_count' => 1,
            'competition_pts' => 600,
        ]);
    }
}
