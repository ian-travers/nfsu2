<?php

namespace App\Models;

trait HasComments
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function comment(string $body, $author, $parent_id = null)
    {
        return Comment::createComment($this, $body, $author, $parent_id);
    }

    public function updateComment($id, $body)
    {
        return Comment::updateComment($id, $body);
    }

    public function deleteComment($id)
    {
        return Comment::deleteComment($id);
    }
}
