<?php

namespace Tests\Feature\User\Settings;

use App\Http\Livewire\User\Notifications;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    /** @test */
    function guest_can_not_visit_notifications_page()
    {
        $this->get('settings/notifications')
            ->assertRedirect('login');
    }

    /** @test */
    function authenticated_user_can_visit_notifications_page()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->get('settings/notifications')
            ->assertSeeLivewire(Notifications::class);
    }

    /** @test */
    function authenticated_user_can_update_notifications_settings()
    {
        $this->signIn($user = User::factory()->create());

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'is_browser_notified' => false,
            'is_email_notified' => false,
        ]);

        Livewire::test(Notifications::class)
            ->set('is_browser_notified', true)
            ->set('is_email_notified', true)
            ->call('submit');

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'is_browser_notified' => true,
            'is_email_notified' => true,
        ]);
    }
}
