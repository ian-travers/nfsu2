<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class ForceDeletePostTest extends TestCase
{
    /** @test */
    function admin_can_delete_any_post()
    {
        $this->signIn(User::factory()->admin()->create());

        $post = Post::factory()->create();

        $this->assertDatabaseCount('posts', 1);

        $this->delete("/adm/posts/{$post->id}/force-delete");

        $this->assertDatabaseCount('posts', 0);

        $this->assertEquals(0, Post::withTrashed()->count());
    }
}
