<?php

namespace Tests\Feature\Comment;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /** @test  */
    function newsitem_page_doesnt_contain_comment_delete_component_for_guest()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->get("/news/{$newsitem->slug}")->assertDontSeeLivewire('comment.delete');
    }

    /** @test  */
    function newsitem_page_contains_comment_delete_component_for_comment_creator()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $user = User::factory()->create();
        $this->signIn($user);

        Comment::factory()->create([
            'commentable_type' => 'news',
            'commentable_id' => $newsitem->id,
            'user_id' => auth()->id(),
        ]);

        $this->get("/news/{$newsitem->slug}")->assertSeeLivewire('comment.delete');
    }

    /** @test  */
    function newsitem_page_doesnt_contain_comment_delete_component_for_another_users_comment()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $user = User::factory()->create();
        $this->signIn($user);

        Comment::factory()->create([
            'commentable_type' => 'news',
            'commentable_id' => $newsitem->id,
        ]);

        $this->get("/news/{$newsitem->slug}")->assertDontSeeLivewire('comment.delete');
    }

    /** @test  */
    function user_can_delete_own_comment()
    {
        $this->signIn();

        $comment = Comment::factory()->create([
            'user_id' => auth()->id(),
        ]);

        $this->assertDatabaseCount('comments', 1);

        Livewire::test('comment.delete')
            ->set('comment', $comment)
            ->call('handle');

        $this->assertDatabaseCount('comments', 0);
    }
}
