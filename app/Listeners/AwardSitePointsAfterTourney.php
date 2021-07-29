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
            } elseif ($place == 2 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_second);
            } elseif ($place == 3 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_third);
            } elseif ($place == 4 && $racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fourth);
            } elseif ($racer->pts) {
                $racer->user->gainSitePoints(app(SitePointsSettings::class)->tourney_fifth_plus);
            }
        }
    }
}
