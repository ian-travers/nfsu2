<?php

namespace Tests\Feature\User\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class EditPostTest extends TestCase
{
    /** @test */
    function guest_cannot_create_a_post()
    {
        $this->patch("/cabinet/posts/1", [])
            ->assertRedirect('login');

        $this->assertDatabaseCount('posts', 0);
    }

    /** @test */
    function user_can_edit_a_post()
    {
        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $post = Post::factory()->create(['author_id' => $user->id]);

        $attributes = [
            'title' => 'Updated Title',
            'excerpt' => 'Updated Excerpt',
            'body' => 'Updated Body',
        ];

        $this->patch("/cabinet/posts/{$post->id}", $attributes);

        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', $attributes);
    }
}
