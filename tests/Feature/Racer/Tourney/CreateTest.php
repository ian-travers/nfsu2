<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\User;
use App\Settings\SeasonSettings;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function racer_can_create_a_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        $attributes = [
            'name' => 'Drag on Mine',
            'track_id' => '1202',
            'room' => 'tourney',
            'started_at' => Carbon::now()->addDays(2),
            'signup_time' => '15',
            'supervisor_id' => $racer->id,
            'supervisor_username' => $racer->username,
            'status' => 'planned',
            'season_id' => app(SeasonSettings::class)->index,
        ];

        $this->post('/cabinet/tourneys', $attributes);

        $this->assertDatabaseCount('tourneys', 1);
    }

    /** @test */
    function guest_cannot_create_a_tourney()
    {
        $this->post('/cabinet/tourneys', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function user_cannot_create_a_tourney()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $this->post('/cabinet/tourneys', [])
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You should promote to the racer.',
            ]);

    }
}
