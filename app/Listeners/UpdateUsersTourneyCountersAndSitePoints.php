<?php

namespace App\Listeners;

use App\Events\TourneyCompleted;
use App\Settings\SitePointsSettings;

class UpdateUsersTourneyCountersAndSitePoints
{
    public function handle(TourneyCompleted $event)
    {
        $racers = $event->tourney->racers;

        $racers->map(function ($racer) {
            if ($racer->pts) {
                $racer->user->incrementTourneysFinishedCount();
                if ($racer->place == 1) {
                    $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_first);
                    $racer->user->incrementPodiumsCount('first_places');
                } elseif ($racer->place == 2) {
                    $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_second);
                    $racer->user->incrementPodiumsCount('second_places');
                } elseif ($racer->place == 3) {
                    $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_third);
                    $racer->user->incrementPodiumsCount('third_places');
                } elseif ($racer->place == 4) {
                    $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fourth);
                } else {
                    $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fifth_plus);
                }
            }
        });
    }
}
