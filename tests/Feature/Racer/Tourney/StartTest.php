<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function racer_can_start_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create([
            'username' => 'supervisor',
        ]);

        $this->signIn($racer);
        $participantsCount = 2;

        $tourney = $this->prepareTourney($racer, $participantsCount);

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/start");

        $this->assertEquals(Tourney::STATUS_ACTIVE, $tourney->fresh()->status);
    }

    protected function prepareTourney(User $racer, int $participants): Tourney
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'started_at' => Carbon::now(),
            'signup_time' => '30',
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => Tourney::STATUS_DRAW,
        ]);

        $racer->signupTourney($tourney);

        $racers = User::factory($participants - 1)->racer()->create();

        $racers->map(function ($racer) use ($tourney) {
            $racer->signupTourney($tourney);
        });

        return $tourney;
    }
}
