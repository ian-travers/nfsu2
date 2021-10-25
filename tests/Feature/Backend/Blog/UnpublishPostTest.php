<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class UnpublishPostTest extends TestCase
{
    /** @test */
    function admin_can_restore_any_post()
    {
        $this->signIn(User::factory()->admin()->create());

        $post = Post::factory()->published()->create();

        $this->assertTrue($post->published);

        $this->patch("adm/posts/{$post->id}/unpublish");

        $this->assertFalse($post->fresh()->published);
    }
}
