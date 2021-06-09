<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemoveTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_remove_trashed_user()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->delete();

        $this->assertTrue($user->trashed());

        $this->signIn(User::factory()->admin()->create());

        $this->assertDatabaseCount('users', 2);

        $this->put("/adm/users/delete/{$user->id}");

        $this->assertDatabaseMissing('users', $user->toArray());
        $this->assertDatabaseCount('users', 1);
    }

    /** @test */
    function admin_cannot_remove_active_user()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->trashed());

        $this->signIn(User::factory()->admin()->create());

        $this->put("/adm/users/delete/{$user->id}")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'You must trash first.',
            ]);

        $this->assertDatabaseCount('users', 2);
    }
}
