<?php

namespace App\Listeners;

use App\Events\TourneyCompleted;
use App\Settings\SitePointsSettings;

class UpdateUsersTourneyCountersAndSitePoints
{
    public function handle(TourneyCompleted $event)
    {
        $racers = $event->tourney->racers;

        foreach ($racers as $racer) {
            if ($racer->place == 1 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_first);
                $racer->user->incrementPodiumsCount('first_places');
                $racer->user->incrementTourneysFinishedCount();
            } elseif ($racer->place == 2 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_second);
                $racer->user->incrementPodiumsCount('second_places');
                $racer->user->incrementTourneysFinishedCount();
            } elseif ($racer->place == 3 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_third);
                $racer->user->incrementPodiumsCount('third_places');
                $racer->user->incrementTourneysFinishedCount();
            } elseif ($racer->place == 4 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fourth);
                $racer->user->incrementTourneysFinishedCount();
            } elseif ($racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fifth_plus);
                $racer->user->incrementTourneysFinishedCount();
            }
        }
    }
}
