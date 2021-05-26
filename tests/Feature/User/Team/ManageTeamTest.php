<?php

namespace Tests\Feature\User\Team;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageTeamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function quest_cannot_visit_manage_team_page()
    {
        $this->get('settings/team')
            ->assertRedirect('login');
    }

    /** @test */
    function user_cannot_edit_a_team()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $this->get('settings/team/edit')
            ->assertRedirect('settings/team')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Insufficient rights to edit the team.'
            ]);
    }

    /** @test */
    function team_member_cannot_edit_a_team()
    {
        $team = Team::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $user->joinTeam($team);

        $this->get('settings/team/edit')
            ->assertRedirect('settings/team')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Insufficient rights to edit the team.'
            ]);
    }

    /** @test */
    function team_captain_can_update_own_team()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        $user->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $user->id,
        ]);

        $data = [
            'clan' => 'RR',
            'name' => 'Race Planet Racers',
            'password' => '1234',
        ];

        $this->patch('settings/team', $data);

        $this->assertDatabaseHas('teams', $data);
    }
}
