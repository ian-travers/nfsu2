<?php

namespace App\Listeners\Tourney;

use App\Events\TourneyCompleted;
use App\Models\News;

class CreateNewsItemWhenCompleted
{
    public function handle(TourneyCompleted $event)
    {
        $tourney = $event->tourney;

        if ($tourney->isCompleted()) {
            $attributes = [
                'title_en' => "{$tourney->name} has been completed",
                'title_ru' => "Турнир {$tourney->name} был завершен",
                'body_en' => "{$tourney->name} tourney, which took place on the {$tourney->trackName()} track at {$tourney->started_at->locale('en_EN')->isoFormat('lll')} is completed. Results information is available on the tourneys page.",
                'body_ru' => "Турнир {$tourney->name}, проходивший на треке {$tourney->trackName()} {$tourney->started_at->locale('ru_RU')->isoFormat('LLL')} Завершен. Информация о результатах размещена на странице турниров.",
                'status' => 1,
            ];

            News::create($attributes);
        }
    }
}
