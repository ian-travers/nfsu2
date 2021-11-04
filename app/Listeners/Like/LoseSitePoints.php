<?php

namespace App\Listeners\Like;

use App\Events\UnlikedOrUndisliked;
use App\Settings\SitePointsSettings;

class LoseSitePoints
{
    public function handle(UnlikedOrUndisliked $event)
    {
        $event->user->loseSitePoints(app(SitePointsSettings::class)->like_dislike);
    }
}
