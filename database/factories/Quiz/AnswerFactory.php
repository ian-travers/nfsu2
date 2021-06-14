<?php

namespace Database\Factories\Quiz;

use App\Models\Quiz\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition()
    {
        return [
            'answer_en' => $this->faker->sentence(),
            'answer_ru' => $this->faker->sentence(),
            'index' => 1,
        ];
    }
}
