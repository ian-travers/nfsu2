<?php

namespace Database\Factories\Conversation;

use App\Models\Conversation\Dialogue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DialogueFactory extends Factory
{
    protected $model = Dialogue::class;

    public function definition()
    {
        return [
            'initiator_id' => User::factory(),
            'companion_id' => User::factory(),
            'blocked' => false,
        ];
    }
}
