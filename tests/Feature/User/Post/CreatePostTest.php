<?php

namespace Tests\Feature\User\Post;

use App\Models\User;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    /** @test */
    function guest_cannot_create_a_post()
    {
        $this->post("/cabinet/posts", [])
            ->assertRedirect('login');

        $this->assertDatabaseCount('posts', 0);
    }

    /** @test */
    function user_can_create_a_post()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $attributes = [
            'title' => 'Test post',
            'excerpt' => 'Excerpt',
            'body' => 'Body',
        ];

        $this->post("/cabinet/posts", $attributes);

        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', $attributes);
    }
}
