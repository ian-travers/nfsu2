<?php

namespace Database\Factories\Conversation;

use App\Models\Conversation\Dialogue;
use App\Models\Conversation\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        /** @var Dialogue $dialogue */
        $dialogue = Dialogue::factory()->create();

        return [
            'dialogue_id' => $dialogue->id,
            'user_id' => $dialogue->companion->id,
            'receiver_id' => $dialogue->initiator->id,
            'body' => $this->faker->sentence(),
            'read_at' => null,
        ];
    }
}
