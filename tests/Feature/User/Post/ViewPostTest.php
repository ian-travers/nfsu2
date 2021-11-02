<?php

namespace Tests\Feature\User\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class ViewPostTest extends TestCase
{
    /** @test */
    function user_can_view_own_post_in_the_cabinet()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $post = Post::factory()->create(['author_id' => $user->id]);

        $this->get("/cabinet/posts/{$post->id}")
            ->assertOk();
    }

    /** @test */
    function user_cannot_view_another_users_post_in_the_cabinet()
    {
        $post = Post::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $this->get("/cabinet/posts/{$post->id}")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => __("Impossible to view someone else's post here."),
            ])
            ->assertRedirect();
    }
}
