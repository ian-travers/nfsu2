<?php

namespace App\Listeners\Post;

use App\Events\PostUnpublished;

class LoseSitePoints
{
    public function handle(PostUnpublished  $event)
    {
        $author = $event->user;

        $author->loseSitePoints(150);
    }
}
