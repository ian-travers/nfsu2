<?php

namespace App\Listeners\Post;

use App\Events\PostPublished;
use App\Settings\SitePointsSettings;

class GainSitePoints
{
    public function handle(PostPublished $event)
    {
        $event->user->gainSitePoints(app(SitePointsSettings::class)->post);
    }
}
