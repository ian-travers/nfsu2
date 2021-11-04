<?php

namespace App\Listeners\Like;

use App\Events\LikedOrDisliked;
use App\Settings\SitePointsSettings;

class GainSitePoints
{
    public function handle(LikedOrDisliked $event)
    {
        $event->user->gainSitePoints(app(SitePointsSettings::class)->like_dislike);
    }
}
