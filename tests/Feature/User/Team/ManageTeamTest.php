<?php

namespace Tests\Feature\User\Team;

use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class ManageTeamTest extends TestCase
{
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

        /** @var User $member */
        $member = User::factory()->create();

        $this->signIn($member);

        $member->joinTeam($team);

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
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);

        $data = [
            'clan' => 'RR',
            'name' => 'Race Planet Racers',
            'password' => '1234',
        ];

        $this->patch('settings/team', $data);

        $this->assertDatabaseHas('teams', $data);
    }

    /** @test */
    function team_captain_may_kick_out_a_member_from_own_team()
    {
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);


        $team = Team::find($captain->team_id);

        /** @var User $member */
        $member = User::factory()->create();
        $member->joinTeam($team);

        $this->assertEquals(2, $team->racers()->count());

        $this->post("settings/team/members/remove/{$member->id}");

        $this->assertEquals(1, $team->racers()->count());
    }

    /** @test */
    function team_captain_cannot_kick_out_himself()
    {
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);

        $this->post("settings/team/members/remove/{$captain->id}")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'Impossible to remove team captain.'
            ]);

        $this->assertCount(1, Team::find($captain->team_id)->racers);
    }

    /** @test */
    function team_captain_cannot_kick_out_a_member_of_another_team()
    {
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);

        /** @var User $anotherMember */
        $anotherMember = User::factory()->create([
            'team_id' => Team::factory()->create(),
        ]);

        $this->post("settings/team/members/remove/{$anotherMember->id}")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'It is impossible to delete a member of another team.'
            ]);

        $this->assertCount(1, Team::find($captain->team_id)->racers);
    }

    /** @test */
    function team_captain_may_transfer_captainship_to_a_member_from_own_team()
    {
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);


        $team = Team::find($captain->team_id);

        /** @var User $member */
        $member = User::factory()->create();
        $member->joinTeam($team);

        $this->post("settings/team/members/transfer/{$member->id}");

        $this->assertTrue($member->isTeamCaptain());
        $this->assertFalse($captain->isTeamCaptain());
        $this->assertTrue($captain->isTeamMember());
    }

    /** @test */
    function team_captain_cannot_transfer_captainship_to_himself()
    {
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);

        $this->post("settings/team/members/transfer/{$captain->id}")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'Impossible to transfer to yourself.'
            ]);
    }

    /** @test */
    function team_captain_cannot_transfer_captainship_to_a_member_of_another_team()
    {
        /** @var User $captain */
        $captain = User::factory()->create();

        $this->signIn($captain);

        $captain->createTeam([
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
            'captain_id' => $captain->id,
        ]);

        /** @var User $anotherMember */
        $anotherMember = User::factory()->create([
            'team_id' => Team::factory()->create(),
        ]);

        $this->post("settings/team/members/transfer/{$anotherMember->id}")
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'It is impossible to transfer captainship to a member of another team.'
            ]);
    }
}
