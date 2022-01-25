<?php

namespace App\Listeners\Tourney;

use App\Models\User;
use App\Notifications\TourneyWasCreated;
use App\Notifications\TourneyWasCreatedEmail;

class NotifyUsersWhenCreated
{
    public function handle($event)
    {
        User::allBrowserNotified()
            ->filter(function ($user) use($event) {
                return $user->id != $event->supervisor->id;
            })
            ->each->notify(new TourneyWasCreated($event->tourney));

        User::allEmailNotified()
            ->filter(function ($user) use($event) {
                return $user->id != $event->supervisor->id;
            })
            ->each->notify(new TourneyWasCreatedEmail($event->tourney));
    }
}
