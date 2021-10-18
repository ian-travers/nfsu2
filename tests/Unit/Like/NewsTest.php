<?php

namespace Tests\Unit\Like;

use App\Models\Like;
use App\Models\News;
use Tests\TestCase;

/**
 * @property News newsitem
 */
class NewsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->newsitem = News::factory()->create();

        $this->signIn();
    }

    /** @test */
    function a_newsitem_can_be_liked()
    {
        $this->newsitem->like();

        $this->assertDatabaseCount('likes', 1);

        $like = Like::find(1);
        $this->assertEquals('like', $like->type_id);
        $this->assertEquals('news', $like->likeable_type);
        $this->assertEquals($like->likeable_id, $this->newsitem->id);
    }

    /** @test */
    function the_same_user_can_like_a_newsitem_only_once()
    {
        $this->newsitem->like();

        $this->assertDatabaseCount('likes', 1);

        $this->newsitem->like();
        $this->assertDatabaseCount('likes', 1);
    }

    /** @test */
    function a_newsitem_can_be_unliked()
    {
        $this->newsitem->like();

        $this->assertDatabaseCount('likes', 1);

        $this->newsitem->unlike();

        $this->assertDatabaseCount('likes', 0);
    }

    /** @test */
    function a_newsitem_can_be_disliked()
    {
        $this->newsitem->dislike();

        $this->assertDatabaseCount('likes', 1);

        $like = Like::find(1);
        $this->assertEquals('dislike', $like->type_id);
        $this->assertEquals('news', $like->likeable_type);
        $this->assertEquals($like->likeable_id, $this->newsitem->id);
    }

    /** @test */
    function the_same_user_can_dislike_a_newsitem_only_once()
    {
        $this->newsitem->dislike();

        $this->assertDatabaseCount('likes', 1);

        $this->newsitem->dislike();
        $this->assertDatabaseCount('likes', 1);
    }

    /** @test */
    function a_newsitem_can_be_undisliked()
    {
        $this->newsitem->dislike();

        $this->assertDatabaseCount('likes', 1);

        $this->newsitem->undislike();

        $this->assertDatabaseCount('likes', 0);
    }
}
