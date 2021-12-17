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

        Dialogue::findWith($companion->username, true);

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

    /** @test */
    function it_has_the_initiator()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => $user->id,
        ]);

        $this->assertTrue($dialogue->initiator->is($user));
        $this->assertFalse($dialogue->companion->is($user));
    }

    /** @test */
    function it_has_the_companion()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'companion_id' => $user->id,
        ]);

        $this->assertTrue($dialogue->companion->is($user));
        $this->assertFalse($dialogue->initiator->is($user));
    }

    /** @test */
    function it_identifies_the_authenticated_user_as_you_and_the_second_in_the_dialogue_as_a_partner()
    {
        /** @var User $initiator */
        $initiator = User::factory()->create();
        /** @var User $companion */
        $companion = User::factory()->create();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => $initiator->id,
            'companion_id' => $companion->id,
        ]);

        $this->signIn($initiator);

        $this->assertTrue($dialogue->you()->is($initiator));
        $this->assertTrue($dialogue->partner()->is($companion));

        $this->signIn($companion);

        $this->assertTrue($dialogue->you()->is($companion));
        $this->assertTrue($dialogue->partner()->is($initiator));
    }

    /** @test */
    function it_has_partner_username()
    {
        /** @var User $initiator */
        $initiator = User::factory()->create();
        /** @var User $companion */
        $companion = User::factory()->create();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => $initiator->id,
            'companion_id' => $companion->id,
        ]);

        $this->signIn($initiator);

        $this->assertEquals($companion->username, $dialogue->partnerUsername);
    }

    /** @test */
    function it_has_correct_path()
    {
        /** @var User $initiator */
        $initiator = User::factory()->create();
        /** @var User $companion */
        $companion = User::factory()->create();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => $initiator->id,
            'companion_id' => $companion->id,
        ]);

        $this->signIn($initiator);

        $this->assertEquals(url("/cabinet/dialogues/{$companion->username}"), $dialogue->frontendPath());
    }

    /** @test */
    function it_may_check_for_unread_messages_for_authenticated_user()
    {
        /** @var User $initiator */
        $initiator = User::factory()->create();
        /** @var User $companion */
        $companion = User::factory()->create();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => $initiator->id,
            'companion_id' => $companion->id,
        ]);

        $this->assertFalse($dialogue->hasUnread());

        $dialogue->addMessage('Hi bro', $companion);

        $this->signIn($initiator);

        $this->assertTrue($dialogue->hasUnread());
    }

    /** @test */
    function it_may_be_marked_as_read()
    {
        /** @var User $initiator */
        $initiator = User::factory()->create();
        /** @var User $companion */
        $companion = User::factory()->create();

        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create([
            'initiator_id' => $initiator->id,
            'companion_id' => $companion->id,
        ]);

        $dialogue->addMessage('Hi bro', $companion);

        $this->signIn($initiator);

        $this->assertTrue($dialogue->hasUnread());

        $dialogue->markAsRead();

        $this->assertFalse($dialogue->hasUnread());
    }
}
