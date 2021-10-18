<?php

namespace Tests\Feature\User\Settings;

use App\Http\Livewire\User\Profile;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /** @test */
    function guest_can_not_visit_profile_page()
    {
        $this->get('settings/profile')
            ->assertRedirect('login');
    }

    /** @test */
    function authenticated_user_can_visit_profile_page()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->get('settings/profile')
            ->assertSeeLivewire(Profile::class);
    }

    /** @test */
    function authenticated_user_can_update_own_profile()
    {
        $this->signIn();

        Livewire::test(Profile::class)
            ->set('username', 'NEED4FUN')
            ->set('email', 'new@mail.com')
            ->set('country', 'AU')
            ->call('submit');

        $this->assertDatabaseHas('users', [
            'username' => 'NEED4FUN',
            'email' => 'new@mail.com',
            'country' => 'AU',
        ]);
    }
}
