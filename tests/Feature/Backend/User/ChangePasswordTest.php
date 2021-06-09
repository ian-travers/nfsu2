<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

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
