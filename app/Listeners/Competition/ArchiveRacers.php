<?php

namespace App\Listeners\Competition;

class ArchiveRacers
{
    public function handle($event)
    {
        /** @var \App\Models\Competition\Competition $competition */
        $competition = $event->competition;

        foreach ($competition->ratings() as $trackName => $rating) {
            foreach ($rating as $racer) {
                if ($user = $competition->racers()->where('username', $racer['username'])->first()) {
                    $user->update([
                        'result' => $user->result . " | {$trackName} - {$racer['result']}",
                        'pts' => $user->pts + $racer['pts'],
                    ]);
                } else {
                    $competition->racers()->create([
                        'place' => $racer['place'],
                        'user_id' => $racer['user_id'],
                        'username' => $racer['username'],
                        'result' => "{$trackName} - {$racer['result']}",
                        'car' => $racer['car'],
                        'pts' => $racer['pts'],
                    ]);
                }
            }
        }
    }
}
