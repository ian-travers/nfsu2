<?php

namespace Tests\Feature\User\Team;

use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /** @test */
    function captain_may_dismiss_the_team()
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

        $this->assertDatabaseCount('teams', 1);

        $this->delete('settings/team');

        $this->assertDatabaseCount('teams', 0);
    }

    /** @test */
    function team_member_cannot_dismiss_the_team()
    {
        /** @var User $member */
        $member = User::factory()->create([
            'team_id' => Team::factory(),
        ]);

        $this->signIn($member);

        $this->delete('settings/team')
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'Only the captain can dismiss the team.'
            ]);

        $this->assertDatabaseCount('teams', 1);
    }
}
