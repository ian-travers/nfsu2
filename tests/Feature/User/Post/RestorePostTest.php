<?php

namespace Tests\Feature\User\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class RestorePostTest extends TestCase
{
    /** @test */
    function user_can_restore_own_post()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Post $post */
        $post = Post::factory()->deleted()->create(['author_id' => $user->id]);

        $this->signIn($user);

        $this->assertEquals(0, Post::count());

        $this->patch("/cabinet/posts/{$post->id}/restore");

        $this->assertEquals(1, Post::count());
    }

    /** @test */
    function user_cannot_restore_another_users_post()
    {
        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Post $post */
        $post = Post::factory()->deleted()->create();

        $this->signIn($user);

        $this->assertEquals(0, Post::count());

        $this->patch("/cabinet/posts/{$post->id}/restore")
            ->assertRedirect();

        $this->assertEquals(0, Post::count());
    }
}
