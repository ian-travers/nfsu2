<?php

namespace Tests\Feature\User;

use App\Http\Livewire\User\DeleteAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_delete_own_account()
    {
        $this->signIn();

        $this->assertDatabaseCount('users', 1);

        Livewire::test(DeleteAccount::class)
            ->set('email', auth()->user()->email)
            ->set('phrase', 'delete my account right now')
            ->call('submit');

        $this->assertDatabaseCount('users', 0);
    }

    /** @test */
    function user_must_provide_his_email()
    {
        $this->signIn();

        $this->assertDatabaseCount('users', 1);

        Livewire::test(DeleteAccount::class)
            ->set('email', 'fake@mail.com')
            ->set('phrase', 'delete my account right now')
            ->call('submit')
            ->assertHasErrors('email');

        $this->assertDatabaseCount('users', 1);
    }

    /** @test */
    function user_must_provide_valid_verify_phrase()
    {
        $this->signIn();

        $this->assertDatabaseCount('users', 1);

        Livewire::test(DeleteAccount::class)
            ->set('email', auth()->user()->email)
            ->set('phrase', 'wrong phrase')
            ->call('submit')
            ->assertHasErrors('phrase');

        $this->assertDatabaseCount('users', 1);
    }
}
