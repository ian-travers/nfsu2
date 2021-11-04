<?php

namespace App\Listeners\Post;

use App\Events\PostUnpublished;
use App\Settings\SitePointsSettings;

class LoseSitePoints
{
    public function handle(PostUnpublished  $event)
    {
        $event->user->loseSitePoints(app(SitePointsSettings::class)->post);
    }
}
