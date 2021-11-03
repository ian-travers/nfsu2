<?php

namespace App\Listeners\Post;

use App\Events\PostPublished;

class GainSitePoints
{
    public function handle(PostPublished $event)
    {
        $event->user->gainSitePoints(150);
    }
}
