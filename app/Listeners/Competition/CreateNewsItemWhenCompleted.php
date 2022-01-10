<?php

namespace App\Listeners\Competition;

use App\Events\CompetitionCompleted;
use App\Models\News;

class CreateNewsItemWhenCompleted
{
    public function handle(CompetitionCompleted $event)
    {
        $competition = $event->competition;

        $attributes = [
            'title_en' => "Current competition has been completed",
            'title_ru' => "Текущее состязание было завершено",
            'body_en' => "Competition, which took place from {$competition->started_at->locale('en_US')->isoFormat('l')} to {$competition->ended_at->locale('en_US')->isoFormat('l')} is completed. Results information is available on the competitions archive page.",
            'body_ru' => "Состязание, проходившее с {$competition->started_at->locale('ru_RU')->isoFormat('l')} по {$competition->ended_at->locale('ru_RU')->isoFormat('l')} завершилось. Результаты доступны на странице архива состязаний.",
            'status' => 1,
        ];

        News::create($attributes);
    }
}
