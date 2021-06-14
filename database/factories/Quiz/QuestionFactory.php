<?php

namespace Database\Factories\Quiz;

use App\Models\Quiz\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'question_en' => $this->faker->sentence(),
            'question_ru' => $this->faker->sentence(),
            'correct_answer' => 1,
        ];
    }
}
