<?php

namespace App\Listeners\Like;

use App\Events\UnlikedOrUndisliked;

class LoseSitePoints
{
    public function handle(UnlikedOrUndisliked $event)
    {
        $event->user->loseSitePoints(1);
    }
}
