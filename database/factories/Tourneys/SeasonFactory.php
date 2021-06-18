<?php

namespace Database\Factories\Tourneys;

use App\Models\Tourneys\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    protected $model = Season::class;

    public function definition()
    {
        return [
            'name' => 'Test Season',
            'status' => $this->model::STATUS_ACTIVE,
        ];
    }

    public function completed()
    {
        return $this->state([
            'status' => $this->model::STATUS_COMPLETE,
        ]);
    }
}
