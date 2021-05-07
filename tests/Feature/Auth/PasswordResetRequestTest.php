<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_request_form()
    {
        $this->get('/forgot-password')
            ->assertOk();
    }

    /** @test */
    function it_email_a_password_reset_link()
    {
        Notification::fake();

        /** @var User $user */
        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }
}
