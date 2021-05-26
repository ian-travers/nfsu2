<?php

namespace Tests\Feature\User\Team;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JoinTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_without_a_team_can_join_a_team()
    {
        $this->signIn();

        /** @var \App\Models\Team $team */
        $team = Team::factory()->create();

        $this->post('settings/team/join', [
            'team_id' => $team->id,
            'password' => $team->password,
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $this->assertTrue($user->isTeamMember());
        $this->assertEquals($team->id, $user->team_id);
    }

    /** @test */
    function team_member_cannot_join_to_another_team()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'team_id' => Team::factory()->create(),
        ]);

        $this->signIn($user);


        /** @var \App\Models\Team $team */
        $team = Team::factory()->create();

        $this->post('settings/team/join', [
            'team_id' => $team->id,
            'password' => $team->password,
        ])
            ->assertRedirect('/settings/team')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You must leave the current team before joining a new one',
            ]);

        $this->assertNotEquals($team->id, $user->team_id);
    }

    /** @test */
    function team_member_can_leave_the_team()
    {
        $this->signIn();

        /** @var \App\Models\Team $team */
        $team = Team::factory()->create();

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->joinTeam($team);

        $this->assertTrue($user->isTeamMember());

        $this->delete('settings/team/join')
            ->assertRedirect('settings/team');

        $this->assertFalse($user->isTeamMember());
    }
}
