<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\Tourney\Tourney;
use App\Models\Tourney\TourneyRacer;
use App\Models\Trophy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function supervisor_can_complete_tourney_which_in_final_status()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create([
            'username' => 'supervisor',
        ]);

        $this->signIn($supervisor);

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $supervisor->id,
            'supervisor_username' => $supervisor->username,
            'status' => Tourney::STATUS_FINAL,
        ]);

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/complete")
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

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/complete");

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

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/complete");

        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 24)->user->first_places);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 20)->user->second_places);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 18)->user->third_places);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 24)->user->podiums);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 20)->user->podiums);
        $this->assertEquals(1, TourneyRacer::firstWhere('pts', 18)->user->podiums);

        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 12)->user->podiums);
        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 10)->user->podiums);
        $this->assertEquals(0, TourneyRacer::firstWhere('pts', 0)->user->podiums);
    }

    /** @test */
    function tourney_winners_get_trophies_when_the_tourney_is_completed()
    {
        /** @var User $supervisor */
        $supervisor = User::factory()->racer()->create();

        $tourney =$this->prepareTourney($supervisor, [24, 20, 18, 12, 10, 0]);

        $this->signIn($supervisor);

        $this->patch("/cabinet/tourneys/handle/{$tourney->id}/complete");

        $this->assertDatabaseCount('trophies', 3);

        $winner = (Trophy::where('place', 1)->first());
        $second = Trophy::where('place', 2)->first();
        $third = Trophy::where('place', 3)->first();

        $this->assertTrue($winner->user->is(TourneyRacer::firstWhere('pts', 24)->user));
        $this->assertTrue($second->user->is(TourneyRacer::firstWhere('pts', 20)->user));
        $this->assertTrue($third->user->is(TourneyRacer::firstWhere('pts', 18)->user));
    }

    protected function prepareTourney(User $supervisor, array $racersPts): Tourney
    {
        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $supervisor->id,
            'supervisor_username' => $supervisor->username,
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
