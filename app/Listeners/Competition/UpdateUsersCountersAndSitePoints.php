<?php

namespace App\Listeners\Competition;

use App\Models\User;
use App\Settings\SitePointsSettings;

class UpdateUsersCountersAndSitePoints
{
    public function handle($event)
    {
        $event->competition->racers->map(function ($racer) {
            if ($user = User::where('username', $racer->username)->first()) {
                $user->increment('competitions_count');
                $user->gainSitePoints(app(SitePointsSettings::class)->competition);
            }
        });
    }
}
