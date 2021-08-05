<?php

namespace Database\Factories\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\User;
use App\Settings\SeasonSettings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TourneyFactory extends Factory
{
    protected $model = Tourney::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'track_id' => Arr::random(['10010', '12020', '11020', '13010']),
            'room' => 'tourney',
            'started_at' => Carbon::now()->addDays(2),
            'signup_time' => '15',
            'supervisor_id' => User::factory(),
            'supervisor_username' => $this->faker->word(),
            'status' => Tourney::STATUS_SCHEDULED,
            'season_id' => app(SeasonSettings::class)->index,
        ];
    }

    public function circuit()
    {
        return $this->state([
            'track_id' => '10010',
        ]);
    }

    public function sprint()
    {
        return $this->state([
            'track_id' => '11020',
        ]);
    }

    public function drag()
    {
        return $this->state([
            'track_id' => '12020',
        ]);
    }

    public function drift()
    {
        return $this->state([
            'track_id' => '13010',
        ]);
    }
}
