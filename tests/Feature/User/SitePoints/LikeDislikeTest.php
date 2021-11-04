<?php

namespace Tests\Feature\User\SitePoints;

use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class LikeDislikeTest extends TestCase
{
    private User $user;
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->signIn($this->user);

        $this->post = Post::factory()->published()->create();
    }

    /** @test */
    function user_gains_site_points_when_like()
    {
        $this->assertEquals(0, $this->user->site_points);

        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleLike');

        $this->assertEquals(1, $this->user->site_points);
    }

    /** @test */
    function user_loses_site_points_when_unlike()
    {
        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleLike');

        $this->assertEquals(1, $this->user->site_points);

        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleLike');

        $this->assertEquals(0, $this->user->site_points);
    }

    /** @test */
    function user_gains_site_points_when_dislike()
    {
        $this->assertEquals(0, $this->user->site_points);

        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleDislike');

        $this->assertEquals(1, $this->user->site_points);
    }

    /** @test */
    function user_loses_site_points_when_undislike()
    {
        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleDislike');

        $this->assertEquals(1, $this->user->site_points);

        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleDislike');

        $this->assertEquals(0, $this->user->site_points);
    }

    /** @test */
    function user_site_points_dont_change_when_like_toggled_to_dislike_and_vice_versa()
    {
        $this->assertEquals(0, $this->user->site_points);

        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleLike');

        $this->assertEquals(1, $this->user->site_points);

        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleDislike');

        $this->assertEquals(1, $this->user->site_points);

        Livewire::test('like-dislike', ['model' => $this->post])
            ->call('toggleLike');

        $this->assertEquals(1, $this->user->site_points);
    }
}
