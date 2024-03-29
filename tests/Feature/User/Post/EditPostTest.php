<?php

namespace Tests\Feature\User\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class EditPostTest extends TestCase
{
    /** @test */
    function guest_cannot_edit_a_post()
    {
        $this->patch("/cabinet/posts/1", [])
            ->assertRedirect('login');

        $this->assertDatabaseCount('posts', 0);
    }

    /** @test */
    function user_can_edit_own_post()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Post $post */
        $post = Post::factory()->create(['author_id' => $user->id]);

        $this->signIn($user);

        $attributes = [
            'title' => 'Updated Title',
            'excerpt' => 'Updated Excerpt',
            'body' => 'Updated Body',
        ];

        $this->patch("/cabinet/posts/{$post->id}", $attributes);

        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', $attributes);
    }

    /** @test */
    function user_cannot_view_edit_page_another_users_post_in_the_cabinet()
    {
        /** @var Post $post */
        $post = Post::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $this->get("/cabinet/posts/{$post->id}/edit")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => __("Impossible to edit someone else's post."),
            ])
            ->assertRedirect();
    }

    /** @test */
    function user_cannot_edit_another_users_post()
    {
        /** @var Post $post */
        $post = Post::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $attributes = [
            'title' => 'Updated Title',
            'excerpt' => 'Updated Excerpt',
            'body' => 'Updated Body',
        ];

        $this->patch("/cabinet/posts/{$post->id}", $attributes);

        $this->assertDatabaseMissing('posts', $attributes);
    }
}
