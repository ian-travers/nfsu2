<?php

namespace App\Listeners\User;

use App\Events\BecomeRacer;

class GainSitePoints
{
    public function handle(BecomeRacer $event)
    {
        $event->user->gainSitePoints(50);
    }
}
