<?php

namespace Tests\Feature\User;

use App\Http\Livewire\User\DeleteAccount;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_delete_own_account()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        Livewire::test(DeleteAccount::class)
            ->set('email', $user->email)
            ->set('phrase', 'delete my account right now')
            ->call('submit');

        $this->assertSoftDeleted($user);
    }

    /** @test */
    function user_must_provide_his_email()
    {
        $this->signIn();

        Livewire::test(DeleteAccount::class)
            ->set('email', 'fake@mail.com')
            ->set('phrase', 'delete my account right now')
            ->call('submit')
            ->assertHasErrors('email');

        $this->assertDatabaseCount('users', 1);
        $this->assertFalse((auth()->user())->trashed());
    }

    /** @test */
    function user_must_provide_valid_verify_phrase()
    {
        $this->signIn();

        Livewire::test(DeleteAccount::class)
            ->set('email', auth()->user()->email)
            ->set('phrase', 'wrong phrase')
            ->call('submit')
            ->assertHasErrors('phrase');

        $this->assertDatabaseCount('users', 1);
        $this->assertFalse((auth()->user())->trashed());
    }

    /** @test */
    function team_captain_cannot_delete_own_account()
    {
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);

        Livewire::test(DeleteAccount::class)
            ->set('email', auth()->user()->email)
            ->set('phrase', 'delete my account right now')
            ->call('submit')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You have to transfer captainship or delete your team first.',
            ])
            ->assertRedirect('settings/account');

        $this->assertFalse($captain->fresh()->trashed());
    }
}
