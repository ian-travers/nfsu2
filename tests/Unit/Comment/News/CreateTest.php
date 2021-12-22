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

    /** @test */
    function it_logs_activity_when_created()
    {
        $this->signIn();

        /** @var News $commentable */
        $commentable = News::factory()->create();

        $comment = Comment::createComment($commentable, 'comment body', auth()->user());

        $this->assertDatabaseCount('activity_log', 1);
        $this->assertDatabaseHas('activity_log', [
            'subject_type' => 'comment',
            'subject_id' => $comment->id,
            'causer_type' => 'App\Models\User',
            'causer_id' => auth()->id(),
            'event' => 'created',
            'description' => 'created',
        ]);
    }
}
