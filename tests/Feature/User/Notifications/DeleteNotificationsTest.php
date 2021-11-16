<?php

namespace Tests\Feature\User\Notifications;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class DeleteNotificationsTest extends TestCase
{
    /** @test */
    function authenticated_user_can_delete_their_notifications()
    {
        /** @var User $user */
        $user = User::factory()->browserNotified()->create();

        /** @var Post $post */
        $post = Post::factory()->create();
        $post->publish();

        $this->assertDatabaseCount('notifications', 1);

        $this->signIn($user);

        $this->delete("/notifications/{$user->notifications()->first()->id}");

        $this->assertDatabaseCount('notifications', 0);
    }
}
