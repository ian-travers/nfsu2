<?php

namespace App\Listeners\Competition;

class ArchiveParticipants
{
    public function handle($event)
    {
        /** @var \App\Models\Competition\Competition $competition */
        $competition = $event->competition;

        foreach ($competition->ratings() as $trackName => $rating) {
            foreach ($rating as $participant) {
                if ($user = $competition->users()->where('username', $participant['username'])->first()) {
                    $user->update(['result' => $user->result . " | {$trackName} - {$participant['result']}"]);
                } else {
                    $competition->users()->create([
                        'place' => $participant['place'],
                        'username' => $participant['username'],
                        'result' => "{$trackName} - {$participant['result']}",
                        'car' => $participant['car'],
                        'pts' => $participant['pts'],
                    ]);
                }
            }
        }
    }
}
