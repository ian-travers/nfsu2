<?php

namespace App\Listeners\Comment;

use App\Events\CommentDeleted;
use App\Settings\SitePointsSettings;

class LoseSitePoints
{
    public function handle(CommentDeleted $event)
    {
        $event->comment->author->loseSitePoints(app(SitePointsSettings::class)->comment);
    }
}
