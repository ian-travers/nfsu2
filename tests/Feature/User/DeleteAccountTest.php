<?php

namespace Tests\Feature\User;

use App\Http\Livewire\User\DeleteAccount;
use App\Models\Tourney\Tourney;
use App\Models\Tourney\TourneyRacer;
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

    /** @test */
    function user_cannot_delete_own_account_until_tourney_is_not_complete()
    {
        /** @var User $user */
        $user = User::factory()->racer()->create();

        TourneyRacer::factory()->create([
            'user_id' => $user->id,
            'racer_username' => $user->username,
            'tourney_id' => Tourney::factory()->create(['status' => 'active']),
        ]);

        $this->signIn($user);

        $user->isSigned();

        Livewire::test(DeleteAccount::class)
            ->set('email', auth()->user()->email)
            ->set('phrase', 'delete my account right now')
            ->call('submit')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You cannot delete account right now. Wait for the tourney to finish.',
            ])
            ->assertRedirect('settings/account');

        $this->assertFalse($user->fresh()->trashed());
    }

    /** @test */
    function supervisor_cannot_delete_own_account_until_his_tourney_is_not_complete_or_has_scheduled_tourneys()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create();

        Tourney::factory()->create([
            'supervisor_id' => $supervisor->id,
        ]);

        $this->signIn($supervisor);


        Livewire::test(DeleteAccount::class)
            ->set('email', auth()->user()->email)
            ->set('phrase', 'delete my account right now')
            ->call('submit')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You cannot delete account. You must handle the current tourney and delete all scheduled.',
            ])
            ->assertRedirect('settings/account');

        $this->assertFalse($supervisor->fresh()->trashed());
    }
}
