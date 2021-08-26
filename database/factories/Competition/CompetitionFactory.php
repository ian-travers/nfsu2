<?php

namespace Database\Factories\Competition;

use App\Models\Competition\Competition;
use App\Settings\SeasonSettings;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    public function definition()
    {
        return [
            'track1_id' => '10011',
            'track2_id' => '11020',
            'started_at' => now()->today()->subDay(),
            'ended_at' => now()->addDays(1),
            'is_completed' => false,
            'season_index' => app(SeasonSettings::class)->index,
        ];
    }
}
