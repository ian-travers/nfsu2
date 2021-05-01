<?php

namespace App\Models\NFSUServer;

use DomainException;
use Illuminate\Support\Collection;

class Ratings
{
    /**
     * C++ structure for NFSU Server v2.5 player statistic (default filename stat.dat)
     *
     * struct PlayerStat {
     * char Name[16];
     * int Rating_All;
     * int Wins_All;
     * int Loses_All;
     * int Disc_All;
     * int REP_All;
     * int OppsREP_All;    // average opponents REP
     * int OppsRating_All;    // average opponents Rating
     * int Rating_Circ;
     * int Wins_Circ;
     * int Loses_Circ;
     * int Disc_Circ;
     * int REP_Circ;
     * int OppsREP_Circ;
     * int OppsRating_Circ;
     * int Rating_Sprint;
     * int Wins_Sprint;
     * int Loses_Sprint;
     * int Disc_Sprint;
     * int REP_Sprint;
     * int OppsREP_Sprint;
     * int OppsRating_Sprint;
     * int Rating_Drag;
     * int Wins_Drag;
     * int Loses_Drag;
     * int Disc_Drag;
     * int REP_Drag;
     * int OppsREP_Drag;
     * int OppsRating_Drag;
     * int Rating_Drift;
     * int Wins_Drift;
     * int Loses_Drift;
     * int Disc_Drift;
     * int REP_Drift;
     * int OppsREP_Drift;
     * int OppsRating_Drift;
     * }
     */
    const OFFSET_OVERALL = 20;
    const OFFSET_CIRCUIT = 48;
    const OFFSET_SPRINT = 76;
    const OFFSET_DRAG = 104;
    const OFFSET_DRIFT = 132;

    protected string $filename;

    /**
     * @throws DomainException|\Throwable
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;

        throw_if(!file_exists($this->filename), DomainException::class);
    }

    public function overall(): Collection
    {
        return $this->getData();
    }

    public function circuit(): Collection
    {
        return $this->getData('circuit');
    }

    public function sprint(): Collection
    {
        return $this->getData('sprint');
    }

    public function drag(): Collection
    {
        return $this->getData('drag');
    }

    public function drift(): Collection
    {
        return $this->getData('drift');
    }

    protected function getData(string $type = 'overall'): Collection
    {
        $rawData = [];

        for ($i = 0; $i < filesize($this->filename); $i += 156) {
            $rawData[] = file_get_contents($this->filename, null, null, $i, 156);
        }

        return collect($rawData)
            ->map(function ($record) use ($type) {
                $name = substr(substr($record, 0, 16), 0, strpos(substr($record, 0, 16), "\x0"));

                switch ($type) {
                    case 'circuit':
                        $wins = $this->getDecValue($record, self::OFFSET_CIRCUIT);
                        $loses = $this->getDecValue($record, self::OFFSET_CIRCUIT + 4);
                        $disconnects = $this->getDecValue($record, self::OFFSET_CIRCUIT + 8);
                        $REP = $this->getDecValue($record, self::OFFSET_CIRCUIT + 12);
                        $avgOppREP = $this->getDecValue($record, self::OFFSET_CIRCUIT + 16);
                        $avgOppRating = $this->getDecValue($record, self::OFFSET_CIRCUIT + 20);
                        break;
                    case 'sprint':
                        $wins = $this->getDecValue($record, self::OFFSET_SPRINT);
                        $loses = $this->getDecValue($record, self::OFFSET_SPRINT + 4);
                        $disconnects = $this->getDecValue($record, self::OFFSET_SPRINT + 8);
                        $REP = $this->getDecValue($record, self::OFFSET_SPRINT + 12);
                        $avgOppREP = $this->getDecValue($record, self::OFFSET_SPRINT + 16);
                        $avgOppRating = $this->getDecValue($record, self::OFFSET_SPRINT + 20);
                        break;
                    case 'drag':
                        $wins = $this->getDecValue($record, self::OFFSET_DRAG);
                        $loses = $this->getDecValue($record, self::OFFSET_DRAG + 4);
                        $disconnects = $this->getDecValue($record, self::OFFSET_DRAG + 8);
                        $REP = $this->getDecValue($record, self::OFFSET_DRAG + 12);
                        $avgOppREP = $this->getDecValue($record, self::OFFSET_DRAG + 16);
                        $avgOppRating = $this->getDecValue($record, self::OFFSET_DRAG + 20);
                        break;
                    case 'drift':
                        $wins = $this->getDecValue($record, self::OFFSET_DRIFT);
                        $loses = $this->getDecValue($record, self::OFFSET_DRIFT + 4);
                        $disconnects = $this->getDecValue($record, self::OFFSET_DRIFT + 8);
                        $REP = $this->getDecValue($record, self::OFFSET_DRIFT + 12);
                        $avgOppREP = $this->getDecValue($record, self::OFFSET_DRIFT + 16);
                        $avgOppRating = $this->getDecValue($record, self::OFFSET_DRIFT + 20);
                        break;
                    default:
                        $wins = $this->getDecValue($record, self::OFFSET_OVERALL);
                        $loses = $this->getDecValue($record, self::OFFSET_OVERALL + 4);
                        $disconnects = $this->getDecValue($record, self::OFFSET_OVERALL + 8);
                        $REP = $this->getDecValue($record, self::OFFSET_OVERALL + 12);
                        $avgOppREP = $this->getDecValue($record, self::OFFSET_OVERALL + 16);
                        $avgOppRating = $this->getDecValue($record, self::OFFSET_OVERALL + 20);
                        break;
                }

                $winsPercent = ($wins + $loses + $disconnects) == 0
                    ? '0%'
                    : round($wins / ($wins + $loses + $disconnects) * 100) . '%';
                $disconnectsPercent = ($wins + $loses + $disconnects) == 0
                    ? '0%'
                    : round($disconnects / ($wins + $loses + $disconnects) * 100) . '%';

                return compact('name', 'wins', 'loses', 'disconnects', 'REP', 'avgOppREP', 'avgOppRating', 'winsPercent', 'disconnectsPercent');
            })->sortByDesc('REP');
    }

    private function getDecValue(string $str, int $offset)
    {
        return hexdec(Helper::str2Hex(substr($str, $offset, 4)));
    }
}
