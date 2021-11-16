<?php

namespace Tests\Feature\User\Notifications;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class ToggleReadNotificationsTest extends TestCase
{
    /** @test */
    function authenticated_user_can_toggle_read_status_their_notifications()
    {
        /** @var User $user */
        $user = User::factory()->browserNotified()->create();

        /** @var Post $post */
        $post = Post::factory()->create();
        $post->publish();

        $this->assertDatabaseCount('notifications', 1);

        $notification = $user->notifications()->first();
        // the notification has unread status
        $this->assertFalse($notification->read());

        $this->signIn($user);
        // Mark as read
        $this->put("/notifications/{$notification->id}");

        $this->assertTrue($notification->fresh()->read());

        // Mark as unread
        $this->put("/notifications/{$notification->id}");

        $this->assertFalse($notification->fresh()->read());
    }
}
