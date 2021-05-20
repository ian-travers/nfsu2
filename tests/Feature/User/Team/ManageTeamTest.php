<?php

namespace Tests\Feature\User\Team;

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
}
