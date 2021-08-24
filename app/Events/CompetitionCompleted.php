<?php

namespace App\Events;

use App\Models\Competition\Competition;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompetitionCompleted
{
    use Dispatchable, SerializesModels;

    public Competition $competition;

    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }
}
