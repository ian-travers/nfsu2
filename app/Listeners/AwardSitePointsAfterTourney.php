<?php

namespace App\Listeners;

use App\Events\TourneyCompleted;
use App\Settings\SitePointsSettings;

class AwardSitePointsAfterTourney
{
    public function handle(TourneyCompleted $event)
    {
        $racers = $event->tourney->racers;

        foreach ($racers as $index => $racer) {
            $ptsAboveRacer = $index ? $racers[$index - 1]->pts : 0;

            $place = $racer->pts == $ptsAboveRacer ? $index : ++$index;

            if ($place == 1 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_first);
                $racer->user->incrementPodiumPlacesCount('first_places');
            } elseif ($place == 2 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_second);
                $racer->user->incrementPodiumPlacesCount('second_places');
            } elseif ($place == 3 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_third);
                $racer->user->incrementPodiumPlacesCount('third_places');
            } elseif ($place == 4 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fourth);
            } elseif ($racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fifth_plus);
            }
        }
    }
}
