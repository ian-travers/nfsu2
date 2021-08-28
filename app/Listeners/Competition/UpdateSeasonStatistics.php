<?php

namespace App\Listeners\Competition;

use App\Events\CompetitionCompleted;
use App\Models\Competition\CompetitionRacer;
use App\Models\Tourney\SeasonRacer;
use App\Settings\SeasonSettings;

class UpdateSeasonStatistics
{
    public function handle(CompetitionCompleted $event)
    {
        $competition = $event->competition;

        $competition->racers->map(function (CompetitionRacer $racer) use ($competition) {
            if ($racer->pts) {
                /** @var SeasonRacer $seasonRacer */
                $seasonRacer = SeasonRacer::firstOrCreate([
                    'season_index' => app(SeasonSettings::class)->index,
                    'user_id' => $racer->user_id,
                    'racer_username' => $racer->username,
                ]);

                $seasonRacer->incrementStatistics('competition', $racer->pts);
            }
        });
    }
}
