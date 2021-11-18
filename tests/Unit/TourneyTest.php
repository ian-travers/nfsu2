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
}
