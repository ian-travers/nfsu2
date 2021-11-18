<?php

namespace App\Listeners\Tourney;

use App\Models\User;
use App\Notifications\TourneyWasCreated;

class NotifyUsersWhenCreated
{
    public function handle($event)
    {
        User::allBrowserNotified()
            ->filter(function ($user) use($event) {
                return $user->id != $event->supervisor->id;
            })
            ->each->notify(new TourneyWasCreated($event->tourney));
    }
}
