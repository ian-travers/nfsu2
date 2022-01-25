<?php

namespace App\Listeners\Post;

use App\Events\PostPublished;
use App\Models\User;
use App\Notifications\PostWasPublished;
use App\Notifications\PostWasPublishedEmail;

class NotifyUsers
{
    public function handle(PostPublished $event)
    {
        User::allBrowserNotified()
            ->filter(function ($user) use($event) {
                return $user->id != $event->user->id;
            })
            ->each->notify(new PostWasPublished($event->post));

        User::allEmailNotified()
            ->filter(function ($user) use($event) {
                return $user->id != $event->user->id;
            })
            ->each->notify(new PostWasPublishedEmail($event->post));
    }
}
