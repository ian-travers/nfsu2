<?php

namespace Tests\Feature\User\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class UnpublishPostTest extends TestCase
{
    /** @test */
    function user_can_unpublish_own_post()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        /** @var Post $post */
        $post = Post::factory()->published()->create(['author_id' => $user->id]);

        $this->assertTrue($post->published);

        $this->patch("/cabinet/posts/{$post->id}/unpublish");

        $this->assertFalse($post->fresh()->published);
    }

    function user_cannot_unpublish_other_users_post()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        /** @var Post $post */
        $post = Post::factory()->published()->create();

        $this->assertTrue($post->published);

        $this->patch("/cabinet/posts/{$post->id}/unpublish")
            ->assertRedirect();

        $this->assertTrue($post->fresh()->published);
    }
}
