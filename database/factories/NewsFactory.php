<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        $title = $this->faker->sentence(4);

        return [
            'title_en' => $title,
            'title_ru' => 'Russian ' . Str::random(),
            'slug' => Str::slug($title),
            'body_en' => $this->faker->paragraphs(4, true),
            'body_ru' => $this->faker->paragraphs(3, true),
            'status' => 0,
        ];
    }
}
