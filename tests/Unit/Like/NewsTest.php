<?php

namespace Tests\Unit\Like;

use App\Models\Like;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_newsitem_can_be_liked()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();
        $newsitem->like();

        $this->assertDatabaseCount('likes', 1);

        $like = Like::find(1);
        $this->assertEquals('like', $like->type_id);
        $this->assertEquals('news', $like->likeable_type);
        $this->assertEquals($like->likeable_id, $newsitem->id);
    }

    /** @test */
    function the_same_user_can_like_a_newsitem_only_once()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();
        $newsitem->like();

        $this->assertDatabaseCount('likes', 1);

        $newsitem->like();
        $this->assertDatabaseCount('likes', 1);
    }

    /** @test */
    function a_newsitem_can_be_unliked()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();
        $newsitem->like();

        $this->assertDatabaseCount('likes', 1);

        $newsitem->unlike();

        $this->assertDatabaseCount('likes', 0);
    }

    /** @test */
    function a_newsitem_can_be_disliked()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();
        $newsitem->dislike();

        $this->assertDatabaseCount('likes', 1);

        $like = Like::find(1);
        $this->assertEquals('dislike', $like->type_id);
        $this->assertEquals('news', $like->likeable_type);
        $this->assertEquals($like->likeable_id, $newsitem->id);
    }

    /** @test */
    function the_same_user_can_dislike_a_newsitem_only_once()
    {
        $this->withoutExceptionHandling();
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();
        $newsitem->dislike();

        $this->assertDatabaseCount('likes', 1);

        $newsitem->dislike();
        $this->assertDatabaseCount('likes', 1);
    }

    /** @test */
    function a_newsitem_can_be_undisliked()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();
        $newsitem->dislike();

        $this->assertDatabaseCount('likes', 1);

        $newsitem->undislike();

        $this->assertDatabaseCount('likes', 0);
    }
}
