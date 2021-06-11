<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrashTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_trash_user()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        $this->assertFalse($user->trashed());

        $this->put("/adm/users/trash/{$user->id}", ['user' => $user]);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
        $this->assertTrue($user->refresh()->trashed());
    }

    /** @test */
    function admin_cannot_trash_team_captain()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $attributes = [
            'clan' => 'TT',
            'name' => 'Test Team',
            'password' => 'password',
        ];

        $user->createTeam($attributes);

        $this->signIn(User::factory()->admin()->create());

        $this->put("/adm/users/trash/{$user->id}", ['user' => $user])
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'The team captain cannot be trashed. Handle with the team first.',
            ]);

        $this->assertFalse($user->refresh()->trashed());
    }

    /** @test */
    function admin_cannot_trash_admin()
    {
        /** @var User $admin */
        $admin = User::factory()->admin()->create();

        $this->signIn($admin);

        $this->put("/adm/users/trash/{$admin->id}", ['user' => $admin])
            ->assertSessionHas('flash', [
                'type' => 'warning',
                'message' => 'The admin cannot be trashed.',
            ]);

        $this->assertFalse($admin->refresh()->trashed());
    }
}
