<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\Tourneys\Season;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function racer_can_create_a_tourney()
    {

        /** @var Season $season */
        $season = Season::factory()->create();

        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        $this->assertDatabaseCount('tourneys', 0);

        $attributes = [
            'name' => 'Drag #1',
            'track' => '1202',
            'started_at' => now(),
            'signup_time' => '15',
            'room' => 'tourney',
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => 1,
            'season_id' => $season->id,
        ];

        $this->post('cabinet/tourneys', $attributes);

        $this->assertDatabaseCount('tourneys', 1);
    }
}
