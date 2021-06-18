<?php

namespace Tests\Unit\Tourney;

use App\Models\Tourneys\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function completing_season_change_status_and_create_a_new_season()
    {
        /** @var Season $season */
        $season = Season::factory()->create();

        $this->assertDatabaseCount('seasons', 1);
        $this->assertEquals('active', $season->status);

        $newOne = $season->complete();

        $this->assertDatabaseCount('seasons', 2);
        $this->assertEquals('complete', $season->status);

        $this->assertEquals('active', $newOne->status);


    }

    /** @test */
    function it_throw_an_exception_when_complete_completed()
    {
        /** @var Season $season */
        $season = Season::factory()->completed()->create();

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Season is already completed.');

        $season->complete();
    }
}
