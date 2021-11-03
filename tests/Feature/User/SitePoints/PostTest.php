<?php

namespace Tests\Feature\User\SitePoints;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    function user_gains_site_points_when_publish_a_post()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Post $post */
        $post = Post::factory()->create(['author_id' => $user->id]);

        $this->signIn($user);

        $this->assertEquals(0, $user->site_points);

        $this->patch("/cabinet/posts/{$post->id}/publish")
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Post has been published.',
            ]);

        $this->assertEquals(150, $user->site_points);
    }

    /** @test */
    function user_loses_site_points_when_unpublish_a_post()
    {
        /** @var User $user */
        $user = User::factory()->create(['site_points' => 150]);

        /** @var Post $post */
        $post = Post::factory()->published()->create(['author_id' => $user->id]);

        $this->signIn($user);

        $this->assertEquals(150, $user->site_points);

        $this->patch("/cabinet/posts/{$post->id}/unpublish")
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Post has been unpublished.',
            ]);

        $this->assertEquals(0, $user->site_points);
    }

    /** @test */
    function user_loses_site_points_when_trash_a_post()
    {
        /** @var User $user */
        $user = User::factory()->create(['site_points' => 150]);

        /** @var Post $post */
        $post = Post::factory()->published()->create(['author_id' => $user->id]);

        $this->signIn($user);

        $this->assertEquals(150, $user->site_points);

        $this->delete("/cabinet/posts/{$post->id}")
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Post has been trashed.',
            ]);

        $this->assertEquals(0, $user->site_points);
    }
}
