<?php

namespace Tests\Feature\Racer;

use App\Http\Livewire\Tourney\Signup;
use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SignupTourneyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_signup()
    {
        Livewire::test(Signup::class)
            ->set('tourney', 1)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'You must log in the site.'
            ]);

        $this->assertDatabaseCount('tourney_racers', 0);
    }

    /** @test */
    function the_user_cannot_signup()
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'started_at' => now()->addMinutes(15),
            'signup_time' => 30,
        ]);

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        Livewire::test(Signup::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You have no right to sign up the tourney. You must pass the racer test first.'
            ]);

        $this->assertDatabaseCount('tourney_racers', 0);
    }

    /** @test */
    function racer_can_sign_up_to_a_signing_tourney()
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
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'You have been signed up the tourney.'
            ]);

        $this->assertDatabaseCount('tourney_racers', 1);
    }

    /** @test */
    function racer_can_sign_up_only_once()
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

        Livewire::test(Signup::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'You may sign up only once.'
            ]);

        $this->assertDatabaseCount('tourney_racers', 1);
    }
}
