<?php

namespace Tests\Feature\Backend;

use App\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /** @test */
    function admin_can_visit_backend_dashboard()
    {
        $this->signIn(User::factory()->admin()->create());

        $this->get('/adm')->assertOk();
    }

    /** @test */
    function guests_cannot_view_backend_dashboard()
    {
        $this->get('/adm')
            ->assertRedirect('/login');
    }

    /** @test */
    function users_cannot_view_backend_dashboard()
    {
        $this->signIn();

        $this->get('/adm')
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'Not enough rights.',
            ]);
    }
}
