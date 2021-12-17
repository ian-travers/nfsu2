<?php

namespace Tests\Feature\User\Dialogue;

use App\Models\User;
use Tests\TestCase;

class StartDialogueTest extends TestCase
{
    /** @test */
    function a_user_may_start_dialogue_with_another_user()
    {
        /** @var User $companion */
        $companion = User::factory()->create();

        $this->signIn(User::factory()->create());

        $this->post("/cabinet/dialogues/{$companion->username}");

        $this->assertDatabaseHas('dialogues', [
            'initiator_id' => auth()->id(),
            'companion_id' => $companion->id,
        ]);
    }
}
