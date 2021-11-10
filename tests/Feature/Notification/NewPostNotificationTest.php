<?php

namespace Tests\Feature\Notification;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class NewPostNotificationTest extends TestCase
{
    /** @test */
    function browser_notified_user_get_it_when_new_post_published()
    {
        /** @var User $user */
        $user = User::factory()->browserNotified()->create();

        $this->assertEquals(0, $user->unreadNotifications()->count());

        /** @var Post $post */
        $post = Post::factory()->create();
        $post->publish();

        $this->assertEquals(1, $user->unreadNotifications()->count());
        $this->assertDatabaseCount('notifications', 1);
    }

    /** @test */
    function browser_notified_user_get_it_when_new_post_published_except_post_author()
    {
        /** @var User $user */
        $user = User::factory()->browserNotified()->create();

        $this->assertEquals(0, $user->unreadNotifications()->count());

        /** @var Post $post */
        $post = Post::factory()->create([
            'author_id' => User::factory()->browserNotified(),
        ]);
        $post->publish();

        $this->assertEquals(1, $user->unreadNotifications()->count());
        $this->assertEquals(0, $post->author->unreadNotifications()->count());
        $this->assertDatabaseCount('notifications', 1);
    }
}
