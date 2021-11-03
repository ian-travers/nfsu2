<?php

namespace App\Listeners\Post;

use App\Events\PostUnpublished;

class LoseSitePoints
{
    public function handle(PostUnpublished  $event)
    {
        $event->user->loseSitePoints(150);
    }
}
