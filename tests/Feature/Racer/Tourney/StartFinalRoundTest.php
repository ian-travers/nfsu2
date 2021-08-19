<?php

namespace Tests\Feature\Racer\Tourney;

use App\Http\Livewire\TourneyHandle\AnnounceFinal;
use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StartFinalRoundTest extends TestCase
{
    use RefreshDatabase;

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
            'status' => Tourney::STATUS_SCHEDULED,
        ]);

        Livewire::test(AnnounceFinal::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You can only announce the final round for an active tourney.',
            ]);

        $this->assertNotEquals(Tourney::STATUS_FINAL, $tourney->fresh()->status);
    }
}
