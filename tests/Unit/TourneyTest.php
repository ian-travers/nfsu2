<?php

namespace Tests\Unit;

use App\Models\Tourney\Tourney;
use Tests\TestCase;

class TourneyTest extends TestCase
{
    /** @test */
    function it_returns_valid_frontend_path()
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create();

        $this->assertEquals("/tourneys/{$tourney->id}", $tourney->frontendPath());
    }

    /** @test */
    function it_logs_activity_when_created()
    {
        Tourney::factory()->create();

        $this->assertDatabaseCount('activity_log', 1);
        $this->assertDatabaseHas('activity_log', ['event' => 'created']);
    }

    /** @test */
    function it_logs_activity_when_deleted()
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create();

        $tourney->delete();

        $this->assertDatabaseCount('activity_log', 2);
        $this->assertDatabaseHas('activity_log', ['event' => 'deleted']);
    }
}
