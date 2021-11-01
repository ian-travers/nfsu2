<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PublishPostTest extends TestCase
{
    /** @test */
    function admin_can_restore_any_post()
    {
        $this->withoutExceptionHandling();
        $this->signIn(User::factory()->admin()->create());

        $post = Post::factory()->create();

        $this->patch("adm/posts/{$post->id}/publish");

        $this->assertTrue($post->fresh()->published);
    }
}
