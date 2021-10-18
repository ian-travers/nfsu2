<?php

namespace Tests\Feature\Racer\Tourney;

use App\Models\User;
use App\Settings\SeasonSettings;
use Carbon\Carbon;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    function racer_can_create_a_tourney()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        $attributes = [
            'name' => 'Drag on Mine',
            'track_id' => '12020',
            'room' => 'tourney',
            'started_at' => Carbon::now()->addDays(2),
            'signup_time' => '15',
            'description' => 'It is fun.',
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
                'message' => 'You should be promoted to the racer.',
            ]);
    }

    /** @test */
    function racer_cannot_create_a_tourney_when_season_is_suspended()
    {
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        app(SeasonSettings::class)->suspend = true;

        $this->post('/cabinet/tourneys', [])
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'Season is suspended.',
            ]);
    }
}
