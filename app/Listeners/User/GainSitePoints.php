<?php

namespace App\Listeners\User;

use App\Events\BecomeRacer;
use App\Settings\SitePointsSettings;

class GainSitePoints
{
    public function handle(BecomeRacer $event)
    {
        $event->user->gainSitePoints(app(SitePointsSettings::class)->pass_racer_test);
    }
}
