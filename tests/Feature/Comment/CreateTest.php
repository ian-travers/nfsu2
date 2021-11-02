<?php

namespace Tests\Feature\Comment;

use App\Models\News;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test  */
    function newsitem_page_doesnt_contain_comment_form_component_for_guest()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->get("/news/{$newsitem->slug}")->assertDontSeeLivewire('comment.form');
    }

    /** @test  */
    function newsitem_page_contains_comment_form_component_for_user()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();

        $this->get("/news/{$newsitem->slug}")->assertSeeLivewire('comment.form');
    }

    /** @test  */
    function user_can_comment_a_newsitem()
    {
        /** @var News $newsitem */
        $newsitem = News::factory()->create();

        $this->signIn();

        Livewire::test('comment.form')
            ->set('commentable', $newsitem)
            ->set('user', auth()->user())
            ->set('body', 'New comment')
            ->call('submitForm');

        $this->assertDatabaseCount('comments', 1);
        $this->assertDatabaseHas('comments', [
            'commentable_type' => 'news',
            'commentable_id' => $newsitem->id,
            'user_id' => auth()->id(),
            'body' => 'New comment',
        ]);
    }
}
