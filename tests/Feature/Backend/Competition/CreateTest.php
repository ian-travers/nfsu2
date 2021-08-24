<?php

namespace Tests\Feature\Backend\Competition;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_create_a_competition()
    {
        $this->signIn(User::factory()->admin()->create());

        $this->post('/adm/competitions', [
            'track1_id' => '10010',
            'started_at' => now(),
            'ended_at' => now()->addDays(7),
            'is_completed' => false,
        ]);

        $this->assertDatabaseCount('competitions', 1);
    }
}
