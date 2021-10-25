<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\User;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    /** @test */
    function admin_can_create_a_post()
    {
        $this->signIn(User::factory()->admin()->create());

        $this->post('/adm/posts', [
            'title' => 'First post',
            'slug' => 'itwillbechanged',
            'excerpt' => 'Excerpt of the post',
            'body' => 'Body of the post',
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'First post',
            'excerpt' => 'Excerpt of the post',
            'body' => 'Body of the post',
        ]);
    }
}
