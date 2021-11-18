<?php

namespace App\Listeners\Tourney;

use App\Events\TourneyCreated;
use App\Settings\SitePointsSettings;

class GainSitePoints
{
    public function handle(TourneyCreated $event)
    {
        $event->supervisor->gainSitePoints(app(SitePointsSettings::class)->create_tourney);
    }
}
