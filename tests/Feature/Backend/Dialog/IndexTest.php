<?php

namespace Tests\Feature\Backend\Dialog;

use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    function admin_can_view_dialogues_index_page()
    {
        $this->signIn(User::factory()->admin()->create());

        $this->get("adm/dialogues")
            ->assertOk();
    }
}
