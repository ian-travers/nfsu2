<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\User;
use App\Settings\SeasonSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function racer_can_delete_own_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
        ]);

        $this->assertDatabaseCount('tourneys', 1);

        $this->delete("/cabinet/tourneys/{$tourney->id}");

        $this->assertDatabaseCount('tourneys', 0);
    }

    /** @test */
    function racer_cannot_delete_someone_else_tourney()
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

        $this->delete("/cabinet/tourneys/{$tourney->id}")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Impossible to delete someone else\'s tourney.'
            ]);

        $this->assertDatabaseCount('tourneys', 1);
    }

    /** @test */
    function racer_may_delete_only_scheduled_or_cancelled_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => Tourney::STATUS_DRAW,
        ]);

        $this->signIn($racer);

        $this->delete("/cabinet/tourneys/{$tourney->id}")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'You may only delete scheduled or cancelled tourneys.'
            ]);

        $this->assertDatabaseCount('tourneys', 1);
    }

    /** @test */
    function racer_cannot_delete_a_tourney_when_season_is_suspended()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
        ]);

        $this->signIn($racer);

        app(SeasonSettings::class)->suspend = true;

        $this->delete("/cabinet/tourneys/{$tourney->id}")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'Season is suspended.'
            ]);
    }
}
