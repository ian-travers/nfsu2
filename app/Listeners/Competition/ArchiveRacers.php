<?php

namespace App\Listeners\Competition;

use App\Events\CompetitionCompleted;
use App\Models\Competition\CompetitionRacer;

class ArchiveRacers
{
    public function handle(CompetitionCompleted $event)
    {
        CompetitionRacer::insert($event->competition->standing()->toArray());
    }
}
