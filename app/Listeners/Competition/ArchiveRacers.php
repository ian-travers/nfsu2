<?php

namespace App\Listeners\Competition;

use App\Models\Competition\CompetitionRacer;

class ArchiveRacers
{
    public function handle($event)
    {
        CompetitionRacer::insert($event->competition->standing()->toArray());
    }
}
