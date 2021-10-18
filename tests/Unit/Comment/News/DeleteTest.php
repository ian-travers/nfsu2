<?php

namespace Tests\Unit\Comment\News;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /** @test */
    function it_deletes_the_comment()
    {
        $this->signIn();

        /** @var News $commentable */
        $commentable = News::factory()->create();

        $comment = Comment::createComment($commentable, 'comment body', auth()->user());

        $this->assertDatabaseHas('comments', $comment->getAttributes());

        Comment::deleteComment($comment->id);

        $this->assertDatabaseMissing('comments', $comment->getAttributes());
        $this->assertDatabaseCount('comments', 0);
    }

    /** @test */
    function it_cannot_delete_a_comment_which_has_a_child()
    {
        $this->signIn();
        $this->expectException(QueryException::class);

        /** @var News $commentable */
        $commentable = News::factory()->create();

        $parentComment = Comment::createComment($commentable, 'parent comment body', auth()->user());
        // create a child comment
        Comment::createComment($commentable, 'child comment body', auth()->user(), $parentComment->id);

        $this->assertDatabaseCount('comments', 2);

        Comment::deleteComment($parentComment->id);

        $this->assertDatabaseCount('comments', 2);
    }
}
