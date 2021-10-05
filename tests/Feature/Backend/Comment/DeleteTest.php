<?php

namespace Tests\Feature\Backend\Comment;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_delete_a_comment()
    {
        $this->signIn(User::factory()->admin()->create());

        $comment = Comment::factory()->create();

        $this->assertDatabaseCount('comments', 1);

        $this->delete("/adm/comments/{$comment->id}");

        $this->assertDatabaseCount('comments', 0);
    }
}
