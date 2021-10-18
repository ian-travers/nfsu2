<?php

namespace Tests\Feature\Auth;

use App\Http\Livewire\Auth\Register;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    function it_requires_a_username()
    {
        Livewire::test(Register::class)
            ->set('country', 'BY')
            ->set('email', 'john@example.com')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['username' => 'required']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_username_must_be_at_least_3_characters()
    {
        Livewire::test(Register::class)
            ->set('username', 'Jo')
            ->call('submit')
            ->assertHasErrors(['username' => 'min']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_username_must_be_less_than_16_characters()
    {
        Livewire::test(Register::class)
            ->set('username', '1234567890123456')
            ->call('submit')
            ->assertHasErrors(['username' => 'max']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_username_must_have_no_spaces()
    {
        Livewire::test(Register::class)
            ->set('username', 'John Doe')
            ->call('submit')
            ->assertHasErrors(['username' => 'regex']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function it_requires_an_email()
    {
        Livewire::test(Register::class)
            ->set('username', 'john')
            ->set('country', 'BY')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['email' => 'required']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function an_email_must_be_valid()
    {
        Livewire::test(Register::class)
            ->set('email', 'john@example')
            ->call('submit')
            ->assertHasErrors(['email' => 'email']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function it_requires_a_password()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('country', 'BY')
            ->set('email', 'john@example.com')
            ->call('submit')
            ->assertHasErrors(['password' => 'required']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_password_must_be_at_least_8_characters()
    {
        Livewire::test(Register::class)
            ->set('password', '1234567')
            ->call('submit')
            ->assertHasErrors(['password' => 'min']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function it_requires_a_country()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('email', 'john@example.com')
            ->set('password', '12345678')
            ->call('submit')
            ->assertHasErrors(['country' => 'required']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function country_must_be_2_characters()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('country', 'ABC')
            ->set('email', 'john@example.com')
            ->set('password', '12345678')
            ->call('submit')
            ->assertHasErrors(['country' => 'size']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function country_must_be_uppercase()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('country', 'by')
            ->set('email', 'john@example.com')
            ->set('password', '12345678')
            ->call('submit')
            ->assertHasErrors(['country' => 'regex']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_guest_can_create_an_account()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('country', 'BY')
            ->set('email', 'john@example.com')
            ->set('password', '12345678')
            ->call('submit');

        $this->assertDatabaseCount('users', 1);
    }
}
