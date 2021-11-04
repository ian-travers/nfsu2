<?php

namespace App\Listeners\Comment;

use App\Events\CommentLeft;
use App\Settings\SitePointsSettings;

class GainSitePoints
{
    public function handle(CommentLeft $event)
    {
        $event->comment->author->gainSitePoints(app(SitePointsSettings::class)->comment);
    }
}
