<?php

namespace App\Listeners\Competition;

use App\Events\CompetitionCompleted;
use App\Models\User;
use App\Settings\SitePointsSettings;

class UpdateUsersCountersAndSitePoints
{
    public function handle(CompetitionCompleted $event)
    {
        $event->competition->racers->map(function ($racer) use($event) {
            if ($user = User::where('username', $racer->username)->first()) {
                $user->increment('competitions_count');
                $user->gainSitePoints(app(SitePointsSettings::class)->competition);

                activity()
                    ->causedBy($user)
                    ->performedOn($event->competition)
                    ->log(__('You took part in the competition'));
            }
        });
    }
}
