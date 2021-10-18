<?php

namespace Tests\Feature\Backend\Competition;

use App\Models\Competition\Competition;
use App\Models\User;
use Tests\TestCase;

class EditTest extends TestCase
{
    /** @test */
    function admin_can_update_a_competition()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $attributes = [
            'started_at' => now(),
            'ended_at' => now()->addDays(7),
            'track1_id' => '10080',
            'track2_id' => '11090',
        ];

        $this->patch("/adm/competitions/{$competition->id}", $attributes);

        $this->assertDatabaseCount('competitions', 1);
        $this->assertDatabaseHas('competitions', $attributes);
    }
}
