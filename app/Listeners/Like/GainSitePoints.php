<?php

namespace App\Listeners\Like;

use App\Events\LikedOrDisliked;

class GainSitePoints
{
    public function handle(LikedOrDisliked $event)
    {
        $event->user->gainSitePoints(1);
    }
}
