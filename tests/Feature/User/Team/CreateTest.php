<?php

namespace Tests\Feature\User\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_without_a_team_can_create_a_team()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->post('settings/team', [
            'clan' => 'RR',
            'name' => 'Race Planet Racers',
            'password' => 'password',
        ]);

        $this->assertDatabaseCount('teams', 1);
    }
}
