<?php

namespace Tests\Feature\Backend\Season;

use App\Http\Livewire\Dashboard\DashboardSeason;
use App\Models\Tourney\SeasonAward;
use App\Models\Tourney\SeasonRacer;
use App\Settings\SeasonSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CompleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_complete_a_season()
    {
        $this->assertEquals(1, app(SeasonSettings::class)->index);

        // TODO: check for admin permission
        // $this->signIn(User::factory()->admin()->create());

        Livewire::test(DashboardSeason::class)
            ->call('complete');

        $this->assertEquals(2, app(SeasonSettings::class)->index);
    }

    /** @test */
    function all_season_winners_get_trophies_when_the_season_is_completed()
    {
        // TODO: check for admin permission
        // $this->signIn(User::factory()->admin()->create());

        $tourneysFirst = SeasonRacer::factory()->firstTourneys()->create();
        $tourneysSecond = SeasonRacer::factory()->secondTourneys()->create();
        $tourneysThird = SeasonRacer::factory()->thirdTourneys()->create();

        $competitionsFirst = SeasonRacer::factory()->firstCompetitions()->create();
        $competitionsSecond = SeasonRacer::factory()->secondCompetitions()->create();
        $competitionsThird = SeasonRacer::factory()->thirdCompetitions()->create();

        // TODO: check for admin permission
        // $this->signIn(User::factory()->admin()->create());

        Livewire::test(DashboardSeason::class)
            ->call('complete');

        $this->assertCount(1, $tourneysFirst->user->seasonOverallAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'overall', 'place' => 1, 'season_index' => 1])
            ->first()->user->is($tourneysFirst->user));
        $this->assertCount(1, $tourneysFirst->user->seasonCircuitAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'circuit', 'place' => 1, 'season_index' => 1])
            ->first()->user->is($tourneysFirst->user));
        $this->assertCount(1, $tourneysFirst->user->seasonSprintAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'sprint', 'place' => 1, 'season_index' => 1])
            ->first()->user->is($tourneysFirst->user));
        $this->assertCount(1, $tourneysFirst->user->seasonDragAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'drag', 'place' => 1, 'season_index' => 1])
            ->first()->user->is($tourneysFirst->user));
        $this->assertCount(1, $tourneysFirst->user->seasonDriftAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'drift', 'place' => 1, 'season_index' => 1])
            ->first()->user->is($tourneysFirst->user));

        $this->assertCount(1, $tourneysSecond->user->seasonOverallAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'overall', 'place' => 2, 'season_index' => 1])
            ->first()->user->is($tourneysSecond->user));
        $this->assertCount(1, $tourneysSecond->user->seasonCircuitAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'circuit', 'place' => 2, 'season_index' => 1])
            ->first()->user->is($tourneysSecond->user));
        $this->assertCount(1, $tourneysSecond->user->seasonSprintAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'sprint', 'place' => 2, 'season_index' => 1])
            ->first()->user->is($tourneysSecond->user));
        $this->assertCount(1, $tourneysSecond->user->seasonDragAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'drag', 'place' => 2, 'season_index' => 1])
            ->first()->user->is($tourneysSecond->user));
        $this->assertCount(1, $tourneysSecond->user->seasonDriftAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'drift', 'place' => 2, 'season_index' => 1])
            ->first()->user->is($tourneysSecond->user));

        $this->assertCount(1, $tourneysThird->user->seasonOverallAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'overall', 'place' => 3, 'season_index' => 1])
            ->first()->user->is($tourneysThird->user));
        $this->assertCount(1, $tourneysThird->user->seasonCircuitAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'circuit', 'place' => 3, 'season_index' => 1])
            ->first()->user->is($tourneysThird->user));
        $this->assertCount(1, $tourneysThird->user->seasonSprintAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'sprint', 'place' => 3, 'season_index' => 1])
            ->first()->user->is($tourneysThird->user));
        $this->assertCount(1, $tourneysThird->user->seasonDragAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'drag', 'place' => 3, 'season_index' => 1])
            ->first()->user->is($tourneysThird->user));
        $this->assertCount(1, $tourneysThird->user->seasonDriftAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'drift', 'place' => 3, 'season_index' => 1])
            ->first()->user->is($tourneysThird->user));

        $this->assertCount(1, $competitionsFirst->user->seasonCompetitionAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'competition', 'place' => 1, 'season_index' => 1])
            ->first()->user->is($competitionsFirst->user));

        $this->assertCount(1, $competitionsSecond->user->seasonCompetitionAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'competition', 'place' => 2, 'season_index' => 1])
            ->first()->user->is($competitionsSecond->user));

        $this->assertCount(1, $competitionsThird->user->seasonCompetitionAwards(1));
        $this->assertTrue(SeasonAward::where(['type' => 'competition', 'place' => 3, 'season_index' => 1])
            ->first()->user->is($competitionsThird->user));
    }
}
