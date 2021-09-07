<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeasonCompleted
{
    use Dispatchable, SerializesModels;

    public int $seasonIndex;

    public function __construct(int $seasonIndex)
    {
        $this->seasonIndex = $seasonIndex;
    }
}
