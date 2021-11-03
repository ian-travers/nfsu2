<?php

namespace App\Listeners\Comment;

use App\Events\CommentLeft;

class GainSitePoints
{
    public function handle(CommentLeft $event)
    {
        $event->comment->author->gainSitePoints(10);
    }
}
