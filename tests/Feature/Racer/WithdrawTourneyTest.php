<?php

namespace Tests\Feature\Racer;

use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WithdrawTourneyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_withdraw()
    {
        $this->post("/tourneys/1/withdraw")
            ->assertRedirect('/login');
    }

    /** @test */
    function the_user_cannot_withdraw()
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'started_at' => now()->addMinutes(15),
            'signup_time' => 30,
        ]);

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $this->post("/tourneys/{$tourney->id}/withdraw");

        $this->assertDatabaseCount('tourney_details', 0);
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

        $this->post("/tourneys/{$tourney->id}/signup");

        $this->assertDatabaseCount('tourney_details', 1);

        $this->post("/tourneys/{$tourney->id}/withdraw");

        $this->assertDatabaseCount('tourney_details', 0);

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

        $this->post("/tourneys/{$tourney->id}/withdraw")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'You have not signed for the tourney.'
            ]);
    }
}
