<?php

namespace App\Listeners\Competition;

use App\Models\User;

class UpdateUsersCountersAndSitePoints
{
    public function handle($event)
    {
        $participants = $event->competition->users;

        $participants->map(function ($participant) {
            if ($user = User::where('username', $participant->username)->first()) {
                $user->increment('competitions_count');
                $user->gainSitePoints(10);
            }
        });
    }
}
