<?php

namespace Tests\Feature\Auth;

use App\Http\Livewire\Auth\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function registered_user_may_log_in()
    {
        $user = $this->CreateUser();

        $this->get('/login')
            ->assertSeeLivewire('auth.login');


        Livewire::test(Login::class)
            ->set('username', $user->username)
            ->set('password', 'password')
            ->call('submit')
            ->assertDontSee('These credentials do not match our records');

        /** @var User $loginUser */
        $loginUser = auth()->user();

        $this->assertEquals($user->email, $loginUser->email);
    }

    /** @test */
    function wrong_credentials_are_displayed()
    {
        $user = $this->CreateUser();

        Livewire::test(Login::class)
            ->set('username', $user->username)
            ->set('password', 'wrong-password')
            ->call('submit')
            ->assertSee('These credentials do not match our records.');

        $this->assertFalse(auth()->check());
    }

    protected function CreateUser(): User
    {
        return User::create([
            'username' => 'John',
            'email' => 'john@example.com',
            'country' => 'BY',
            'password' => bcrypt('password'),
        ]);
    }
}
