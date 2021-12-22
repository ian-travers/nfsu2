<?php

namespace App\Listeners\Competition;

use App\Events\CompetitionCompleted;

class RewardCompetitionWinners
{
    public function handle(CompetitionCompleted $event)
    {
        $event->competition->racers->filter->isPodium()->map(function ($racer) use($event) {
            $event->competition->trophies()->create([
                'user_id' => $racer->user->id,
                'place' => $racer->place,
            ]);
        });
    }
}
