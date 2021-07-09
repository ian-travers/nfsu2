<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StartFinalRoundTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function racer_can_announce_final_round_of_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create([
            'username' => 'supervisor',
        ]);

        $this->signIn($racer);

        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => Tourney::STATUS_ACTIVE,
        ]);

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/final");

        $this->assertEquals(Tourney::STATUS_FINAL, $tourney->fresh()->status);
    }

    /** @test */
    function racer_can_only_announce_final_round_for_an_active_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create([
            'username' => 'supervisor',
        ]);

        $this->signIn($racer);

        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => Tourney::STATUS_SCHEDULED,
        ]);

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/final")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You can only announce the final round for an active tourney.',
            ]);

        $this->assertNotEquals(Tourney::STATUS_FINAL, $tourney->fresh()->status);
    }
}
