<?php

namespace Tests\Feature\Racer\Tourney;

use App\Http\Livewire\TourneyHandle\Draw;
use App\Models\Tourney\Tourney;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class DrawTest extends TestCase
{
    /** @test */
    function racer_can_draw_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);
        $participantsCount = 9; // it will 3 * 4 regular + 1 final rounds

        $tourney = $this->prepareTourney($racer, $participantsCount);

        $this->assertDatabaseCount('tourney_racers', $participantsCount);

        Livewire::test(Draw::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertDatabaseCount('heats', 13);
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

        Livewire::test(Draw::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertDatabaseCount('heats', 13);

        Livewire::test(Draw::class)
            ->set('tourney', $tourney)
            ->call('handle');

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

        Livewire::test(Draw::class)
            ->set('tourney', $tourney)
            ->call('handle');

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

        Livewire::test(Draw::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertDatabaseCount('heats', 0);
    }

    protected function prepareTourney(User $racer, int $participants): Tourney
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'started_at' => now(),
            'supervisor_id' => $racer->id,
        ]);

        $racer->signupTourney($tourney);

        $racers = User::factory($participants - 1)->racer()->create();

        $racers->map(function ($racer) use ($tourney) {
            $racer->signupTourney($tourney);
        });

        return $tourney;
    }
}
