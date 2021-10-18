<?php

namespace Tests\Unit\Comment\News;

use App\Models\Comment;
use App\Models\News;
use Tests\TestCase;

class EditTest extends TestCase
{
    /** @test */
    function it_updates_the_comment()
    {
        $this->signIn();

        /** @var News $commentable */
        $commentable = News::factory()->create();

        $comment = Comment::createComment($commentable, 'comment body', auth()->user());

        Comment::updateComment($comment->id, ['body' => 'updated']);

        $this->assertEquals('updated', $comment->fresh()->body);
    }
}
