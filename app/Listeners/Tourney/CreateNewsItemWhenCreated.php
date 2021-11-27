<?php

namespace App\Listeners\Tourney;

use App\Events\TourneyCreated;
use App\Models\News;

class CreateNewsItemWhenCreated
{
    public function handle(TourneyCreated $event)
    {
        $tourney = $event->tourney;

        if ($tourney->isScheduled()) {
            $attributes = [
                'title_en' => 'New tourney was scheduled',
                'title_ru' => 'Запланирован новый турнир',
                'body_en' => "New tournament added to this season's schedule. According to preliminary information, it will take place on the {$tourney->trackName()} track at {$tourney->started_at->locale('en_EN')->isoFormat('lll')}. More information is available on the tournaments page.",
                'body_ru' => "В расписании этого сезона запланирован новый турнир. По предварительным данным турнир будет проходить на треке {$tourney->trackName()}. Начало {$tourney->started_at->locale('ru_RU')->isoFormat('lll')}. Более подробная информации размещена на странице турниров.",
                'status' => 1,
            ];

            News::create($attributes);
        }
    }
}
