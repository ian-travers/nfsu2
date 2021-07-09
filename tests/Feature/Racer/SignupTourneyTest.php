<?php

namespace Tests\Feature\Racer;

use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignupTourneyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_signup()
    {
        $this->post("/tourneys/1/signup")
            ->assertRedirect('/login');
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

        $this->post("/tourneys/{$tourney->id}/signup");

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

        $this->post("/tourneys/{$tourney->id}/signup");

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

        $this->post("/tourneys/{$tourney->id}/signup");

        $this->assertDatabaseCount('tourney_racers', 1);

        $this->post("/tourneys/{$tourney->id}/signup")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'You may sign up only once.'
            ]);

        $this->assertDatabaseCount('tourney_racers', 1);
    }
}
