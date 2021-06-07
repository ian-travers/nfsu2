<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashBoardTest extends TestCase
{
    use RefreshDatabase;

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
