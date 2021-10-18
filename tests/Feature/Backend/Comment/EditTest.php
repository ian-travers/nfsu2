<?php

namespace Tests\Feature\Backend\Comment;

use App\Models\Comment;
use App\Models\User;
use Tests\TestCase;

class EditTest extends TestCase
{
    /** @test */
    function admin_can_update_a_comment()
    {
        $this->signIn(User::factory()->admin()->create());

        $comment = Comment::factory()->create();

        $attributes = ['body' => 'Updated comment'];

        $this->patch("/adm/comments/{$comment->id}", $attributes);

        $this->assertDatabaseCount('comments', 1);
        $this->assertDatabaseHas('comments', $attributes);
    }
}
