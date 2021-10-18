<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\User;
use App\Settings\SeasonSettings;
use Carbon\Carbon;
use Tests\TestCase;

class EditTest extends TestCase
{
    /** @test */
    function racer_can_edit_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
        ]);

        $attributes = [
            'name' => 'Name UPD',
            'track_id' => '12021',
            'room' => 'new room',
            'signup_time' => '30',
            'started_at' => Carbon::now()->addDays(4),
        ];

        $this->patch("/cabinet/tourneys/{$tourney->id}", $attributes);

        $this->assertDatabaseHas('tourneys', $attributes);
    }

    /** @test */
    function racer_cannot_edit_someone_else_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
        ]);

        /** @var User $someoneElse */
        $someoneElse = User::factory()->racer()->create();

        $this->signIn($someoneElse);

        $attributes = [
            'name' => 'Name UPD',
            'track_id' => '1302',
            'room' => 'new room',
            'signup_time' => '30',
            'started_at' => Carbon::now()->addDays(4),
        ];

        $this->patch("/cabinet/tourneys/{$tourney->id}", $attributes)
            ->assertSessionHas('flash', [
               'type' => 'error',
                'message' => 'Impossible to edit someone else\'s tourney.'
            ]);

        $this->assertDatabaseMissing('tourneys', $attributes);
    }

    /** @test */
    function racer_cannot_edit_a_tourney_when_season_is_suspended()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
        ]);

        app(SeasonSettings::class)->suspend = true;

        $this->patch("/cabinet/tourneys/{$tourney->id}", [])
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'Season is suspended.',
            ]);
    }
}
