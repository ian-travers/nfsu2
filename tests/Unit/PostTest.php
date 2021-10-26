<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    function it_return_a_slug()
    {
        $this->assertEquals('the-best-post-00000001', $this->createTestPost()->slug);
    }

    /** @test */
    function it_has_unique_slug()
    {
        $this->assertEquals('the-best-post-00000001', $this->createTestPost()->slug);
        $this->assertEquals('the-best-post-00000002', $this->createTestPost()->slug);
    }

    /** @test */
    function it_might_be_published()
    {
        /** @var Post $post */
        $post = Post::factory()->create();

        $this->assertFalse($post->published);

        $post->publish();

        $this->assertTrue($post->published);
    }

    /** @test */
    function it_might_be_unpublished()
    {
        /** @var Post $post */
        $post = Post::factory()->published()->create();

        $this->assertTrue($post->published);

        $post->unpublish();

        $this->assertFalse($post->published);
    }

    /** @test */
    function it_detect_when_it_has_an_image()
    {
        /** @var Post $post */
        $post = Post::factory()->make();

        $this->assertFalse($post->hasImage());

        /** @var Post $postWithImage */
        $postWithImage = Post::factory()->make([
            'image' => 'cover-image.jpeg',
        ]);

        $this->assertTrue($postWithImage->hasImage());
    }

    protected function createTestPost(): Post
    {
        return Post::factory()->create([
            'title' => 'The best post',
        ]);
    }
}
