<?php

namespace Tests\Feature\User\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PublishPostTest extends TestCase
{
    /** @test */
    function user_can_publish_own_post()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        /** @var Post $post */
        $post = Post::factory()->create(['author_id' => $user->id]);

        $this->assertFalse($post->published);

        $this->patch("/cabinet/posts/{$post->id}/publish");

        $this->assertTrue($post->fresh()->published);
    }

    function user_cannot_publish_other_users_post()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        /** @var Post $post */
        $post = Post::factory()->create();

        $this->assertFalse($post->published);

        $this->patch("/cabinet/posts/{$post->id}/publish")
            ->assertRedirect();

        $this->assertFalse($post->fresh()->published);
    }
}
