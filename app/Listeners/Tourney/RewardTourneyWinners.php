<?php

namespace App\Listeners\Tourney;

class RewardTourneyWinners
{
    public function handle($event)
    {
        $event->tourney->racers->filter->isPodium()->map(function ($racer) use($event) {
            $event->tourney->trophies()->create([
                'user_id' => $racer->user->id,
                'place' => $racer->place,
            ]);
        });
    }
}
