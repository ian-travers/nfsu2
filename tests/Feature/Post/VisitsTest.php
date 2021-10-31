<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Tests\TestCase;

class VisitsTest extends TestCase
{
    /** @test */
    function viewing_post_increments_its_visits()
    {
        /** @var Post $post */
        $post = Post::factory()->published()->create();

        $this->assertEquals(0, visits($post)->count());

        $this->get("/blog/{$post->slug}");

        $this->assertEquals(1, visits($post)->count());
    }
}
