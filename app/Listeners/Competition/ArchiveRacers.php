<?php

namespace App\Listeners\Competition;

class ArchiveRacers
{
    public function handle($event)
    {
        /** @var \App\Models\Competition\Competition $competition */
        $competition = $event->competition;

        foreach ($competition->standing() as $racer) {

            $competition->racers()->create([
                'place' => $racer['place'],
                'user_id' => $racer['user_id'],
                'username' => $racer['username'],
                'result' => $racer['result'],
                'car' => $racer['car'],
                'pts' => $racer['pts'],
            ]);
        }
    }
}
