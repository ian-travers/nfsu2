<?php

namespace Tests\Feature\Backend\Competition;

use App\Models\Competition\Competition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_remove_a_competition()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->assertDatabaseCount('competitions', 1);

        $this->delete("/adm/competitions/{$competition->id}");

        $this->assertDatabaseCount('competitions', 0);
    }
}
