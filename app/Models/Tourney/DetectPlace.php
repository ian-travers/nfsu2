<?php

namespace App\Models\Tourney;

use Illuminate\Support\Collection;

trait DetectPlace
{
    /**
     * Determines the place of the racer in the collection, sorted in descending order of pts.
     *
     * @param $index
     * @param $pts
     * @param \Illuminate\Support\Collection $racersAbove
     *
     * @return int
     */
    protected function detectPlace($index, $pts, Collection $racersAbove): int
    {
        return $racersAbove->count()
            ? ($pts == $racersAbove->last()->pts
                ? $this->detectPlace($index - 1, $racersAbove->last()->pts, $racersAbove->take($index - 1))
                : ++$index)
            : 1;
    }
}
