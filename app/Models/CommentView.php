<?php

namespace App\Models;

class CommentView
{
    public Comment $comment;
    /**
     * @var self[]
     */
    public array $children;

    public function __construct(Comment $comment, array $children)
    {
        $this->comment = $comment;
        $this->children = $children;
    }
}
