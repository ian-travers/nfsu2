<?php

namespace App\Listeners\Comment;

use App\Events\CommentDeleted;

class LoseSitePoints
{
    public function handle(CommentDeleted $event)
    {
        $event->comment->author->loseSitePoints(10);
    }
}
