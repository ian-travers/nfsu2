<?php

namespace App\Events;

use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TourneyCreated
{
    use Dispatchable, SerializesModels;

    public User $supervisor;
    public Tourney $tourney;

    public function __construct(User $supervisor, Tourney $tourney)
    {
        $this->supervisor = $supervisor;
        $this->tourney = $tourney;
    }
}
