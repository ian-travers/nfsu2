<?php

namespace Tests\Unit\Conversation;

use App\Models\Conversation\Dialogue;
use App\Models\User;
use Tests\TestCase;

class DialogueTest extends TestCase
{
    /** @test */
    function it_creates_a_dialog_for_current_user_with_existing_user()
    {
        /** @var User $companion */
        $companion = User::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $this->signIn($user);

        Dialogue::getOrCreateWith($companion->username);

        $this->assertDatabaseCount('dialogues',1);
        $this->assertDatabaseHas('dialogues', [
            'initiator_id' => $user->id,
            'companion_id' => $companion->id,
        ]);
    }

    /** @test */
    function it_may_add_a_message_from_authenticated_user()
    {
        $this->signIn();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => auth()->id(),
        ]);

        $dialogue->addMessage('Hello there');

        $this->assertDatabaseCount('messages',1);
        $this->assertDatabaseHas('messages', [
            'dialogue_id' => $dialogue->id,
            'user_id' => auth()->id(),
            'body' => 'Hello there',
        ]);
    }
}
