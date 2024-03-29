<?php

namespace Tests\Feature\User\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class TrashPostTest extends TestCase
{
    /** @test */
    function user_can_trash_own_post()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $post = Post::factory()->create(['author_id' => $user->id]);

        $this->delete("/cabinet/posts/{$post->id}");

        $this->assertEquals(0, Post::count());
        $this->assertEquals(1, Post::withTrashed()->count());
    }

    /** @test */
    function user_cannot_trash_another_users_post()
    {
        $post = Post::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $this->delete("/cabinet/posts/{$post->id}");

        $this->assertEquals(1, Post::count());
    }
}
