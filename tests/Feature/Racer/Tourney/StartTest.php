<?php

namespace Tests\Feature\Racer\Tourney;

use App\Http\Livewire\TourneyHandle\Draw;
use App\Http\Livewire\TourneyHandle\Start;
use App\Models\Tourney\Tourney;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class StartTest extends TestCase
{
    /** @test */
    function racer_cannot_confirm_draw_and_start_completed_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $tourney = Tourney::factory()->create([
            'started_at' => now()->subMinute(),
            'supervisor_id' => $racer->id,
            'status' => Tourney::STATUS_COMPLETED,
        ]);

        $this->signIn($racer);

        Livewire::test(Start::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Tourney is already completed.'
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
            'started_at' => now()->subMinute(),
            'supervisor_id' => $racer->id,
            'status' => Tourney::STATUS_CANCELLED,

        ]);

        $this->signIn($racer);

        Livewire::test(Start::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Tourney is already cancelled.'
            ]);

        $this->assertFalse($tourney->fresh()->isActive());
    }

    /** @test */
    function racer_can_confirm_draw_and_start_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);
        $tourney = $this->prepareTourney($racer, 2);

        Livewire::test(Draw::class)
            ->set('tourney', $tourney)
            ->call('handle');

        Livewire::test(Start::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertTrue($tourney->fresh()->isActive());
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
