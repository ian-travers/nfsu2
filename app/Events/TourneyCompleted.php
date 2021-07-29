<?php

namespace App\Events;

use App\Models\Tourney\Tourney;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TourneyCompleted
{
    use Dispatchable, SerializesModels;

    public Tourney $tourney;

    public function __construct(Tourney $tourney)
    {
        $this->tourney = $tourney;
    }
}
