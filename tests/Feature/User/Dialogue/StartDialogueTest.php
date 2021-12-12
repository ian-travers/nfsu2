<?php

namespace Tests\Feature\User\Dialogue;

use App\Models\Conversation\Dialogue;
use App\Models\User;
use Tests\TestCase;

class StartDialogueTest extends TestCase
{
    /** @test */
    function a_user_may_start_dialogue_with_another_user()
    {
        $this->withoutExceptionHandling();
        /** @var User $companion */
        $companion = User::factory()->create();

        $this->signIn(User::factory()->create());

        $this->post("/cabinet/dialogues/{$companion->username}", ['body' => 'Hello there']);

        $this->assertDatabaseHas('dialogues', [
            'initiator_id' => auth()->id(),
            'companion_id' => $companion->id,
        ]);
        $this->assertDatabaseHas('messages', [
            'dialogue_id' => Dialogue::where([
                'initiator_id' => auth()->id(),
                'companion_id' => $companion->id,
            ])->first()->id,
            'user_id' => auth()->id(),
            'body' => 'Hello there',
        ]);
    }
}
