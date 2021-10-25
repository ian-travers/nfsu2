<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class EditPostTest extends TestCase
{
    /** @test */
    function admin_can_edit_any_post()
    {
        $this->signIn(User::factory()->admin()->create());

        $post = Post::factory()->create();

        $attributes = [
            'title' => 'Updated title',
            'excerpt' => 'Updated excerpt',
            'body' => 'Updated body',
        ];

        $this->patch("/adm/posts/{$post->id}", $attributes);

        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', $attributes);
    }
}
