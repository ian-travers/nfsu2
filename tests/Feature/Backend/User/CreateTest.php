<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    function admin_can_create_a_user()
    {
        $this->signIn(User::factory()->admin()->create());

        $attributes = [
            'username' => 'Jon',
            'email' => 'jon@example.com',
            'country' => 'BY',
            'role' => User::ROLE_USER,
            'password' => 'password',
        ];

        $this->post('/adm/users', $attributes);

        unset($attributes['password']);

        $this->assertDatabaseHas('users', $attributes);
    }
}
