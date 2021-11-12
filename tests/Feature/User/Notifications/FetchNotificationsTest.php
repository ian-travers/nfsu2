<?php

namespace Tests\Feature\User\Notifications;

use Tests\TestCase;

class FetchNotificationsTest extends TestCase
{
    /** @test */
    function guest_cannot_visit_notifications_page()
    {
        $this->get('/notifications')
            ->assertRedirect('login');
    }

    /** @test */
    function authenticated_user_can_visit_their_notifications_page()
    {
        $this->signIn();

        $this->get('/notifications')
            ->assertOk();
    }
}
