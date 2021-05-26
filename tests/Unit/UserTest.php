<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_may_have_an_avatar()
    {
        /** @var User $user */
        $user = User::factory()->make([
            'avatar' => 'path_to_avatar',
        ]);

        $this->assertTrue($user->hasAvatar());
    }

    /** @test */
    function it_detects_team_membership()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->isTeamMember());

        /** @var \App\Models\Team $team */
        $team = Team::factory()->create();

        $user->joinTeam($team);

        $this->assertTrue($user->isTeamMember());
    }

    /** @test */
    function it_detects_team_captainship()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $user->createTeam([
            'clan' => 'RR',
            'name' => 'Race Planet Racers',
            'password' => 'password',
            'captain_id' => $user->id,
        ]);

        $this->assertTrue($user->isTeamCaptain());
    }
}
