<?php

namespace Database\Factories\Competition;

use App\Models\Competition\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    public function definition()
    {
        return [
            'track1_id' => Arr::random(['10010', '12020', '11020', '13010']),
            'started_at' => now()->today()->subDay(),
            'ended_at' => now()->addDays(1),
            'is_completed' => false,
        ];
    }
}
