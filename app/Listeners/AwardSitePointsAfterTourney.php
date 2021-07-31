<?php

namespace App\Listeners;

use App\Events\TourneyCompleted;
use App\Settings\SitePointsSettings;

class AwardSitePointsAfterTourney
{
    public function handle(TourneyCompleted $event)
    {
        $racers = $event->tourney->racers;

        foreach ($racers as $racer) {
            if ($racer->place == 1 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_first);
                $racer->user->incrementPodiumPlacesCount('first_places');
            } elseif ($racer->place == 2 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_second);
                $racer->user->incrementPodiumPlacesCount('second_places');
            } elseif ($racer->place == 3 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_third);
                $racer->user->incrementPodiumPlacesCount('third_places');
            } elseif ($racer->place == 4 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fourth);
            } elseif ($racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fifth_plus);
            }
        }
    }
}
