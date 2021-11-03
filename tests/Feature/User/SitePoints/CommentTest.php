<?php

namespace Tests\Feature\User\SitePoints;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /** @test */
    function user_gains_site_points_when_leave_a_comment()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Post $post */
        $newsitem = News::factory()->create();

        $this->signIn($user);

        $this->assertEquals(0, $user->site_points);

        $this->signIn();

        Livewire::test('comment.form')
            ->set('commentable', $newsitem)
            ->set('user', $user)
            ->set('body', 'New comment')
            ->call('submitForm');

        $this->assertEquals(10, $user->fresh()->site_points);
    }

    /** @test */
    function user_loses_site_points_when_delete_a_comment()
    {
        /** @var User $user */
        $user = User::factory()->create(['site_points' => 10]);

        /** @var Comment $post */
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->signIn($user);

        $this->assertEquals(10, $user->site_points);

        Livewire::test('comment.delete')
            ->set('comment', $comment)
            ->call('handle');

        $this->assertEquals(0, $user->fresh()->site_points);
    }
}
