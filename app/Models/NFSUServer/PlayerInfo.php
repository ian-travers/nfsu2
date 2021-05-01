<?php

namespace App\Models\NFSUServer;

class PlayerInfo
{
    protected string $name;
    protected Ratings $ratings;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->ratings = new Ratings(config('nfsu-server.path') . '/stat.dat');
    }

    public function isExists()
    {
        return (bool)$this->ratings->overall()->firstWhere('name', $this->name);
    }

    public function statistics()
    {
        if (!$this->isExists()) {
            return [];
        }

        $overallInfo = $this->ratings->overall()->firstWhere('name', $this->name);
        $overallRating = $this->ratings->overall()->pluck('name')->search($this->name);

        $circuitInfo = $this->ratings->circuit()->firstWhere('name', $this->name);
        $circuitRating = $this->ratings->circuit()->pluck('name')->search($this->name);

        $sprintInfo = $this->ratings->sprint()->firstWhere('name', $this->name);
        $sprintRating = $this->ratings->sprint()->pluck('name')->search($this->name);

        $dragInfo = $this->ratings->drag()->firstWhere('name', $this->name);
        $dragRating = $this->ratings->drag()->pluck('name')->search($this->name);

        $driftInfo = $this->ratings->drift()->firstWhere('name', $this->name);
        $driftRating = $this->ratings->drift()->pluck('name')->search($this->name);

        return [
            'overall' => ['rating' => $overallRating + 1] + $overallInfo,
            'circuit' => ['rating' => $circuitRating + 1] + $circuitInfo,
            'sprint' => ['rating' => $sprintRating + 1] + $sprintInfo,
            'drag' => ['rating' => $dragRating + 1] + $dragInfo,
            'drift' => ['rating' => $driftRating + 1] + $driftInfo,
        ];
    }
}
