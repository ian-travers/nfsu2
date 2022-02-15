<?php

namespace Tests\Feature\Backend\Dialog;

use App\Models\Conversation\Dialogue;
use App\Models\User;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /** @test */
    function admin_can_view_dialogue_page()
    {
        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        $this->get("adm/dialogues/{$dialogue->id}")
            ->assertOk();
    }
}
