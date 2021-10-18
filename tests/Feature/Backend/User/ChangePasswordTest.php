<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    /** @test */
    function admin_can_create_a_user()
    {
        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn(User::factory()->admin()->create());


        $this->post("/adm/users/change-password", [
            'id' => $user->id,
            'password' => 'top-secret'
        ]);

        $this->assertTrue(Hash::check('top-secret', $user->fresh()->password));
    }
}
