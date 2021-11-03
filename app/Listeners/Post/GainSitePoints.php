<?php

namespace App\Listeners\Post;

use App\Events\PostPublished;

class GainSitePoints
{
    public function handle(PostPublished $event)
    {
        $author = $event->user;

        $author->gainSitePoints(150);
    }
}
