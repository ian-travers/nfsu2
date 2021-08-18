<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DrawTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function racer_can_draw_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);
        $participantsCount = 9; // it will 3 * 4 regular + 1 final rounds

        $tourney = $this->prepareTourney($racer, $participantsCount);

        $this->assertDatabaseCount('tourney_racers', $participantsCount);

        $this->put("/cabinet/tourneys/handle/{$tourney->id}/draw");

        $this->assertDatabaseCount('heats', 13);
    }

    /** @test */
    function racer_can_confirm_draw_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);
        $participantsCount = 2;

        $tourney = $this->prepareTourney($racer, $participantsCount);

        $this->put("/cabinet/tourneys/handle/{$tourney->id}/draw");
        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/start");

        $this->assertTrue($tourney->fresh()->isActive());
    }

    /** @test */
    function racer_cannot_confirm_draw_completed_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => Tourney::STATUS_COMPLETED,
        ]);

        $this->signIn($racer);

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/start")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Tourney is completed.'
            ]);

        $this->assertFalse($tourney->fresh()->isActive());
    }

    /** @test */
    function racer_cannot_confirm_draw_cancelled_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => Tourney::STATUS_CANCELLED,
        ]);

        $this->signIn($racer);

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/start")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Tourney is cancelled.'
            ]);

        $this->assertFalse($tourney->fresh()->isActive());
    }

    /** @test */
    function racer_cannon_draw_own_tourney_with_double_heats_records()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);
        $participantsCount = 9; // it will 3 * 4 regular + 1 final rounds

        $tourney = $this->prepareTourney($racer, $participantsCount);

        $this->assertDatabaseCount('tourney_racers', $participantsCount);

        $this->put("/cabinet/tourneys/handle/{$tourney->id}/draw");

        $this->assertDatabaseCount('heats', 13);

        $this->put("/cabinet/tourneys/handle/{$tourney->id}/draw");

        $this->assertDatabaseCount('heats', 13);
    }

    /** @test */
    function racer_cannot_draw_someones_else_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);
        $participantsCount = 2;

        $tourney = $this->prepareTourney($racer, $participantsCount);

        $this->signIn(User::factory()->racer()->create());

        $this->assertDatabaseCount('tourney_racers', $participantsCount);

        $this->put("/cabinet/tourneys/handle/{$tourney->id}/draw")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => "Unable to draw someone's else tourney."
            ]);

        $this->assertDatabaseCount('heats', 0);
    }

    /** @test */
    function user_cannot_draw_a_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        $tourney = $this->prepareTourney($racer, 0);

        $this->signIn(User::factory()->create());

        $this->assertDatabaseCount('tourney_racers', 1);

        $this->put("/cabinet/tourneys/handle/{$tourney->id}/draw")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You should be promoted to the racer.'
            ]);

        $this->assertDatabaseCount('heats', 0);
    }

    protected function prepareTourney(User $racer, int $participants): Tourney
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'started_at' => Carbon::now(),
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
        ]);

        $racer->signupTourney($tourney);

        $racers = User::factory($participants - 1)->racer()->create();

        $racers->map(function ($racer) use ($tourney) {
            $racer->signupTourney($tourney);
        });

        return $tourney;
    }
}
