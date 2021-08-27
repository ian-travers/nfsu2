<?php

namespace App\Listeners\Competition;

class RewardCompetitionWinners
{
    public function handle($event)
    {
        $event->competition->racers->filter->isPodium()->map(function ($racer) use($event) {
            $event->competition->trophies()->create([
                'user_id' => $racer->user->id,
                'place' => $racer->place,
            ]);
        });
    }
}
