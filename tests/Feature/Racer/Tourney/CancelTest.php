<?php

namespace Tests\Feature\Racer\Tourney;

use App\Http\Livewire\TourneyHandle\Cancel;
use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CancelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function racer_can_cancel_a_cancellable_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'started_at' => now()->subMinute(),
        ]);

        Livewire::test(Cancel::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Tourney has been cancelled.',
            ]);

        $this->assertEquals(Tourney::STATUS_CANCELLED, $tourney->fresh()->status);
    }
}
