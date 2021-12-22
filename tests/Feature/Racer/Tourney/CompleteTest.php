<?php

namespace Tests\Feature\Racer\Tourney;

use App\Http\Livewire\TourneyHandle\Complete;
use App\Models\Tourney\SeasonRacer;
use App\Models\Tourney\Tourney;
use App\Models\Tourney\TourneyRacer;
use App\Models\Trophy;
use App\Models\User;
use App\Settings\SeasonSettings;
use Livewire\Livewire;
use Tests\TestCase;

class CompleteTest extends TestCase
{
    /** @test */
    function racer_can_complete_tourney_which_in_final_status()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'status' => Tourney::STATUS_FINAL,
        ]);

        Livewire::test(Complete::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Tourney has been completed.',
            ]);

        $this->assertEquals(Tourney::STATUS_COMPLETED, $tourney->fresh()->status);
    }

    /** @test */
    function each_tourney_racer_earns_site_points_when_the_tourney_is_completed()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create();

        $tourney =$this->prepareTourney($supervisor, [24, 20, 18, 12, 10, 0]);

        $this->signIn($supervisor);

        Livewire::test(Complete::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertEquals(10, TourneyRacer::firstWhere('pts', 24)->user->site_points);
        $this->assertEquals(9, TourneyRacer::firstWhere('pts', 20)->user->site_points);
        $this->assertEquals(8, TourneyRacer::firstWhere('pts', 18)->user->site_points);
        $this->assertEquals(8, TourneyRacer::firstWhere('pts', 12)->user->site_points);
        $this->assertEquals(6, TourneyRacer::firstWhere('pts', 10)->user->site_points);
        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 0)->user->site_points);
    }

    /** @test */
    function tourney_winners_increase_their_associated_counters_when_the_tourney_is_completed()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create();

        $tourney =$this->prepareTourney($supervisor, [24, 20, 18, 12, 10, 0]);

        $this->signIn($supervisor);

        Livewire::test(Complete::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 24)->user->tourneys_finished_count);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 20)->user->tourneys_finished_count);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 18)->user->tourneys_finished_count);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 12)->user->tourneys_finished_count);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 10)->user->tourneys_finished_count);
        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 0)->user->tourneys_finished_count);

        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 24)->user->first_places);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 20)->user->second_places);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 18)->user->third_places);

        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 24)->user->tourneyPodiums);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 20)->user->tourneyPodiums);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 18)->user->tourneyPodiums);

        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 12)->user->tourneyPodiums);
        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 10)->user->tourneyPodiums);
        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 0)->user->tourneyPodiums);
    }

    /** @test */
    function tourney_winners_get_trophies_when_the_tourney_is_completed()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create();

        $tourney =$this->prepareTourney($supervisor, [24, 20, 18, 12, 10, 0]);

        $this->signIn($supervisor);

        Livewire::test(Complete::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertDatabaseCount('trophies', 3);

        $winner = (Trophy::where('place', 1)->first());
        $second = Trophy::where('place', 2)->first();
        $third = Trophy::where('place', 3)->first();

        $this->assertTrue($winner->user->is(TourneyRacer::firstWhere('pts', 24)->user));
        $this->assertTrue($second->user->is(TourneyRacer::firstWhere('pts', 20)->user));
        $this->assertTrue($third->user->is(TourneyRacer::firstWhere('pts', 18)->user));
    }

    /** @test */
    function each_tourney_racer_updates_their_season_statistic_when_the_tourney_is_completed()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create();

        $tourney =$this->prepareTourney($supervisor, [24, 20, 0]);

        $this->signIn($supervisor);

        Livewire::test(Complete::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $place1 = TourneyRacer::where(['pts' => 24, 'tourney_id' => $tourney->id])->first();
        $place2 = TourneyRacer::where(['pts' => 20, 'tourney_id' => $tourney->id])->first();

        $sr = SeasonRacer::where(['user_id' => $place1->user_id, 'season_index' => app(SeasonSettings::class)->index])->first();
        $this->assertEquals(1, $sr->circuit_count);
        $this->assertEquals(24, $sr->circuit_pts);

        $sr = SeasonRacer::where(['user_id' => $place2->user_id, 'season_index' => app(SeasonSettings::class)->index])->first();
        $this->assertEquals(1, $sr->circuit_count);
        $this->assertEquals(20, $sr->circuit_pts);

        $this->assertDatabaseCount('season_racers', 2);
    }

    /** @test */
    function each_tourney_racer_logs_activity_when_the_tourney_is_completed()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create();

        $tourney =$this->prepareTourney($supervisor, [24, 20, 0]);

        $this->signIn($supervisor);

        Livewire::test(Complete::class)
            ->set('tourney', $tourney)
            ->call('handle');

        $this->assertDatabaseCount('activity_log', 3); // 1 create tourney + 2 took part
    }

    protected function prepareTourney(User $supervisor, array $racersPts): Tourney
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->circuit()->create([
            'supervisor_id' => $supervisor->id,
            'status' => Tourney::STATUS_FINAL,
        ]);

        foreach ($racersPts as $pts) {
            TourneyRacer::factory()->create([
                'tourney_id' => $tourney->id,
                'pts' => $pts,
            ]);
        }

        return $tourney;
    }
}
