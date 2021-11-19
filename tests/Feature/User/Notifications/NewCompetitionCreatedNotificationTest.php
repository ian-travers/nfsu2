<?php

namespace Tests\Feature\User\Notifications;

use App\Models\Competition\Competition;
use App\Models\User;
use Tests\TestCase;

class NewCompetitionCreatedNotificationTest extends TestCase
{
    /** @test */
    function browser_notified_user_get_it_when_new_competition_created()
    {
        /** @var User $user */
        $user = User::factory()->browserNotified()->create();

        Competition::factory()->create();

        $this->assertEquals(1, $user->fresh()->notifications->count());
        $this->assertDatabaseCount('notifications', 1);
    }
}
