<?php

namespace Tests\Feature\User;

use App\Http\Livewire\User\ChangePassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    /** @test */
    function user_can_change_own_password()
    {
        $this->signIn();

        Livewire::test(ChangePassword::class)
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('submit');

        /** @var User $user */
        $user = auth()->user();

        $this->assertTrue(Hash::check('password', $user->password));
    }

    /** @test */
    function it_requires_a_password()
    {
        $this->signIn();

        Livewire::test(ChangePassword::class)
            ->set('password', '')
            ->set('password_confirmation', '')
            ->call('submit')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function new_password_must_be_at_least_8_characters()
    {
        $this->signIn();

        Livewire::test(ChangePassword::class)
            ->set('password', '1234567')
            ->set('password_confirmation', '12345678')
            ->call('submit')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    function new_password_must_be_confirmed()
    {
        $this->signIn();

        Livewire::test(ChangePassword::class)
            ->set('password', 'password')
            ->set('password_confirmation', 'bla-bla-bla')
            ->call('submit')
            ->assertHasErrors(['password' => 'confirmed']);
    }

    /** @test */
    function new_password_must_not_contains_spaces()
    {
        $this->signIn();

        Livewire::test(ChangePassword::class)
            ->set('password', 'pass word')
            ->set('password_confirmation', 'pass word')
            ->call('submit')
            ->assertHasErrors(['password' => 'regex']);
    }
}
