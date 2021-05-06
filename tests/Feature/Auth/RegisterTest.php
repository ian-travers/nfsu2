<?php

namespace Tests\Feature\Auth;

use App\Http\Livewire\Auth\Register;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function register_page_contains_necessary_livewire_component()
    {
        $this->get('/register')
            ->assertSeeLivewire('auth.register');
    }

    /** @test */
    function it_requires_a_username()
    {
        Livewire::test(Register::class)
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
            ->set('email', 'john@example.com')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['username' => 'min']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_username_must_be_less_than_16_characters()
    {
        Livewire::test(Register::class)
            ->set('username', '1234567890123456')
            ->set('email', 'john@example.com')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['username' => 'max']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_username_must_have_no_spaces()
    {
        Livewire::test(Register::class)
            ->set('username', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['username' => 'regex']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function it_requires_an_email()
    {
        Livewire::test(Register::class)
            ->set('username', 'john')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['email' => 'required']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function an_email_must_be_valid()
    {
        Livewire::test(Register::class)
            ->set('username', 'JohnDoe')
            ->set('email', 'john@example')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['email' => 'email']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function it_requires_a_password()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('email', 'john@example.com')
            ->call('submit')
            ->assertHasErrors(['password' => 'required']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_password_must_be_at_least_8_characters()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('email', 'john@example.com')
            ->set('password', '1234567')
            ->call('submit')
            ->assertHasErrors(['password' => 'min']);

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function a_guest_can_create_an_account()
    {
        Livewire::test(Register::class)
            ->set('username', 'John')
            ->set('email', 'john@example.com')
            ->set('password', '12345678')
            ->call('submit');

        $this->assertDatabaseCount('users', 1);
    }
}
