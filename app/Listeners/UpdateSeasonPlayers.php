<?php

namespace App\Listeners;

use App\Events\TourneyCompleted;
use App\Models\Tourney\SeasonRacer;
use App\Models\Tourney\TourneyRacer;
use App\Settings\SeasonSettings;

class UpdateSeasonPlayers
{
    public function handle(TourneyCompleted $event)
    {
        $tourney = $event->tourney;

        $tourney->racers->map(function (TourneyRacer $racer) use ($tourney) {
            if ($racer->pts) {
                /** @var SeasonRacer $seasonRacer */
                $seasonRacer = SeasonRacer::firstOrCreate([
                    'season_index' => app(SeasonSettings::class)->index,
                    'user_id' => $racer->user_id,
                ]);

                $seasonRacer->incrementStatistics($tourney->type(), $racer->pts);
            }
        });
    }
}
