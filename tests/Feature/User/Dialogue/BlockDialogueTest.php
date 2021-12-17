<?php

namespace Tests\Feature\User\Dialogue;

use App\Models\Conversation\Dialogue;
use App\Models\User;
use Tests\TestCase;

class BlockDialogueTest extends TestCase
{
    /** @test */
    function authenticated_user_can_block_the_dialogue()
    {
        $this->signIn(User::factory()->create());

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => auth()->id(),
        ]);

        $this->assertFalse($dialogue->isBlocked());

        $this->patch("/cabinet/dialogues/{$dialogue->partnerUsername}/block");

        $this->assertTrue($dialogue->fresh()->isBlocked());
    }
}
