<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
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

    /** @test */
    function it_has_default_role()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->assertEquals('user', $user->role);
    }

    /** @test */
    function it_detects_the_user()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $this->assertTrue($user->isUser());
    }

    /** @test */
    function it_detects_the_racer()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'role' => User::ROLE_RACER,
        ]);

        $this->assertTrue($user->isRacer());
    }

    /** @test */
    function it_detects_the_supervisor()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'role' => User::ROLE_SUPERVISOR,
        ]);

        $this->assertTrue($user->isSupervisor());
    }

    /** @test */
    function it_might_change_a_role()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $this->assertTrue($user->isUser());
        $this->assertFalse($user->isRacer());
        $this->assertFalse($user->isSupervisor());

        $user->changeRole(User::ROLE_RACER);

        $this->assertFalse($user->isUser());
        $this->assertTrue($user->isRacer());
        $this->assertFalse($user->isSupervisor());

        $user->changeRole(User::ROLE_SUPERVISOR);

        $this->assertFalse($user->isUser());
        $this->assertFalse($user->isRacer());
        $this->assertTrue($user->isSupervisor());
    }

    /** @test */
    function it_throws_an_invalid_argument_exception_when_change_the_role()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $this->expectException(\InvalidArgumentException::class);

        $user->changeRole('fake_role');
    }

    /** @test */
    function it_throws_a_domain_exception_when_change_the_role()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'role' => User::ROLE_RACER,
        ]);

        $this->expectException(\DomainException::class);

        $user->changeRole(User::ROLE_RACER);
    }

    /** @test */
    function it_detects_the_admin()
    {
        /** @var User $user */
        $user = User::factory()->admin()->create();

        $this->assertTrue($user->isAdmin());
    }

    /** @test */
    function it_may_assign_an_admin()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->isAdmin());

        $user->setAdminRights();

        $this->assertTrue($user->isAdmin());
    }

    /** @test */
    function it_detects_browser_notified()
    {
        /** @var User $user */
        $user = User::factory()->make();

        $this->assertFalse($user->browserNotified());

        /** @var User $user */
        $user = User::factory()->browserNotified()->make();

        $this->assertTrue($user->browserNotified());
    }

    /** @test */
    function it_detects_email_notified()
    {
        /** @var User $user */
        $user = User::factory()->make();

        $this->assertFalse($user->emailNotified());

        /** @var User $user */
        $user = User::factory()->emailNotified()->make();

        $this->assertTrue($user->emailNotified());
    }

    /** @test */
    function it_sets_browser_notified()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->browserNotified());

        $user->setBrowserNotified();

        $this->assertTrue($user->browserNotified());
    }

    /** @test */
    function it_unsets_browser_notified()
    {
        /** @var User $user */
        $user = User::factory()->browserNotified()->create();

        $this->assertTrue($user->browserNotified());

        $user->unsetBrowserNotified();

        $this->assertFalse($user->browserNotified());
    }

    /** @test */
    function it_sets_email_notified()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->emailNotified());

        $user->setEmailNotified();

        $this->assertTrue($user->emailNotified());
    }

    /** @test */
    function it_unsets_email_notified()
    {
        /** @var User $user */
        $user = User::factory()->emailNotified()->create();

        $this->assertTrue($user->emailNotified());

        $user->unsetEmailNotified();

        $this->assertFalse($user->emailNotified());
    }
}
