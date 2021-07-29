<?php

namespace App\Listeners;

use App\Events\TourneyCompleted;
use App\Settings\SitePointsSettings;
use Illuminate\Support\Collection;

class AwardSitePointsAfterTourney
{
    public function handle(TourneyCompleted $event)
    {
        $racers = $event->tourney->racers;

        foreach ($racers as $index => $racer) {
            // if any racers have equal pts -> the same place
            $place = $index ? $this->detectPlace($index, $racer->pts, $racers->take($index)) : 1;

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

    /**
     * Determines the place of the racer in the collection, sorted in descending order of pts.
     *
     * @param $index
     * @param $pts
     * @param \Illuminate\Support\Collection $racersAbove
     * @return int
     *
     * @todo Extract as a utility function.
     */
    protected function detectPlace($index, $pts, Collection $racersAbove): int
    {
        return $racersAbove->count()
            ? ($pts == $racersAbove->last()->pts
                ? $this->detectPlace($index - 1, $racersAbove->last()->pts, $racersAbove->take($index - 1))
                : ++$index)
            : 1;
    }
}
