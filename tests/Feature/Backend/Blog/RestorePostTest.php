<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class RestorePostTest extends TestCase
{
    /** @test */
    function admin_can_restore_any_post()
    {
        $this->signIn(User::factory()->admin()->create());

        $post = Post::factory()->create();

        $this->delete("adm/posts/{$post->id}");

        $this->assertEquals(0, Post::count());

        $this->patch("adm/posts/{$post->id}/restore");

        $this->assertEquals(1, Post::count());
    }
}
