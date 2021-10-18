<?php

namespace Tests\Unit\Like;

use App\Models\Comment;
use App\Models\Like;
use Tests\TestCase;

/**
 * @property  Comment $comment
 */
class CommentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->comment = Comment::factory()->create();

        $this->signIn();
    }

    /** @test */
    function a_newsitem_comment_can_be_liked()
    {
        $this->comment->like();

        $this->assertDatabaseCount('likes', 1);

        $like = Like::find(1);
        $this->assertEquals('like', $like->type_id);
        $this->assertEquals('comment', $like->likeable_type);
        $this->assertEquals($like->likeable_id, $this->comment->id);
    }

    /** @test */
    function the_same_user_can_like_a_newsitem_comment_only_once()
    {
        $this->comment->like();

        $this->assertDatabaseCount('likes', 1);

        $this->comment->like();
        $this->assertDatabaseCount('likes', 1);
    }

    /** @test */
    function a_newsitem_comment_can_be_unliked()
    {
        $this->comment->like();

        $this->assertDatabaseCount('likes', 1);

        $this->comment->unlike();

        $this->assertDatabaseCount('likes', 0);
    }

    /** @test */
    function a_newsitem_comment_can_be_disliked()
    {
        $this->comment->dislike();

        $this->assertDatabaseCount('likes', 1);

        $like = Like::find(1);
        $this->assertEquals('dislike', $like->type_id);
        $this->assertEquals('comment', $like->likeable_type);
        $this->assertEquals($like->likeable_id, $this->comment->id);
    }

    /** @test */
    function the_same_user_can_dislike_a_newsitem_comment_only_once()
    {
        $this->comment->dislike();

        $this->assertDatabaseCount('likes', 1);

        $this->comment->dislike();
        $this->assertDatabaseCount('likes', 1);
    }

    /** @test */
    function a_newsitem_comment_can_be_undisliked()
    {
        $this->comment->dislike();

        $this->assertDatabaseCount('likes', 1);

        $this->comment->undislike();

        $this->assertDatabaseCount('likes', 0);
    }
}
