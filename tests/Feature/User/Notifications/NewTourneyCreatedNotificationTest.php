<?php

namespace Tests\Feature\User\Notifications;

use App\Models\User;
use Tests\TestCase;

class NewTourneyCreatedNotificationTest extends TestCase
{
    /** @test */
    function browser_notified_user_get_it_when_new_tourney_created_except_supervisor()
    {
        /** @var User $user */
        $user = User::factory()->browserNotified()->create();

        $this->assertEquals(0, $user->notifications->count());

        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->browserNotified()->create();

        $this->signIn($supervisor);

        $attributes = [
            'name' => 'Market Street',
            'track_id' => '10010',
            'room' => 'tourney',
            'started_at' => now()->addDays(2),
            'signup_time' => '15',
            'description' => 'Test tourney'
        ];

        $this->post("/cabinet/tourneys", $attributes);

        $this->assertEquals(1, $user->fresh()->notifications->count());
        $this->assertEquals(0, $supervisor->fresh()->notifications->count());
        $this->assertDatabaseCount('notifications', 1);
    }
}
