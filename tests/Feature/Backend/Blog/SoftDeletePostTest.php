<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class SoftDeletePostTest extends TestCase
{
    /** @test */
    function admin_can_trash_any_post()
    {
        $this->signIn(User::factory()->admin()->create());

        $post = Post::factory()->create();

        $this->assertDatabaseCount('posts', 1);

        $this->delete("/adm/posts/{$post->id}");

        $this->assertEquals(0, Post::count());
        $this->assertEquals(1, Post::withTrashed()->count());
    }
}
