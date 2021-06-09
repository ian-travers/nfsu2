<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_edit_a_user()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        $attributes = [
            'username' => 'Jon',
            'role' => User::ROLE_RACER,
            'country' => 'BY',
            'email' => 'jon@example.com',
        ];

        $this->patch("/adm/users/{$user->id}", $attributes);

        $this->assertDatabaseHas('users', $attributes);
    }
}
