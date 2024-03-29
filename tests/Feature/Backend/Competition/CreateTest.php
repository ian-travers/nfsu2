<?php

namespace Tests\Feature\Backend\Competition;

use App\Models\User;
use App\Settings\SeasonSettings;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    function admin_can_create_a_competition()
    {
        $this->signIn(User::factory()->admin()->create());

        $this->post('/adm/competitions', [
            'track1_id' => '10010',
            'started_at' => now(),
            'ended_at' => now()->addDays(7),
            'is_completed' => false,
            'season_index' => app(SeasonSettings::class)->index,
        ]);

        $this->assertDatabaseCount('competitions', 1);
    }
}
