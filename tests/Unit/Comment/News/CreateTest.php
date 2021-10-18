<?php

namespace Tests\Unit\Comment\News;

use App\Models\Comment;
use App\Models\News;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    function it_creates_a_comment()
    {
        $this->signIn();

        /** @var News $commentable */
        $commentable = News::factory()->create();

        $comment = Comment::createComment($commentable, 'comment body', auth()->user());

        $this->assertDatabaseHas('comments', $comment->getAttributes());
    }
}
