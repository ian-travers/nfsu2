<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Tests\TestCase;

class RestoreTest extends TestCase
{
    /** @test */
    function admin_can_restore_trashed_user()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->delete();

        $this->assertTrue($user->trashed());

        $this->signIn(User::factory()->admin()->create());

        $this->put("/adm/users/restore/{$user->id}");

        $this->assertFalse($user->refresh()->trashed());
    }
}
