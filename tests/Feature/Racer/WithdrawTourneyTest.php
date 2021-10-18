<?php

namespace Tests\Feature\Racer;

use App\Http\Livewire\Tourney\Signup;
use App\Http\Livewire\Tourney\Withdraw;
use App\Models\Tourney\Tourney;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class WithdrawTourneyTest extends TestCase
{
    /** @test */
    function guest_cannot_withdraw()
    {
        Livewire::test(Withdraw::class)
            ->set('tourney', 1)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'You must log in the site.'
            ]);

        $this->assertDatabaseCount('tourney_racers', 0);
    }

    /** @test */
    function racer_can_withdraw_for_the_signing_tourney()
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'started_at' => now()->addMinutes(15),
            'signup_time' => 30,
        ]);

        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        Livewire::test(Signup::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertDatabaseCount('tourney_racers', 1);

        Livewire::test(Withdraw::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'You have been withdrawn from the tourney.'
            ]);

        $this->assertDatabaseCount('tourney_racers', 0);

    }

    /** @test */
    function racer_cannot_withdraw_without_signing()
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'started_at' => now()->addMinutes(15),
            'signup_time' => 30,
        ]);

        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        Livewire::test(Withdraw::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'You have not signed for the tourney.'
            ]);
    }
}
