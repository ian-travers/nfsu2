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

    const RATINGS_LIMIT = 100;
    const PAGINATION_PER_PAGE = 20;

    protected string $filename;

    /**
     * @throws DomainException|\Throwable
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;

        throw_unless(file_exists($this->filename), new DomainException(__('Can not connect to the NFSU server live data.')));
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
                switch ($type) {
                    case 'circuit':
                        $data = unpack('iwins/iloses/idisconnects/iREP/iavgOppREP/iavgOppRating', $record, static::OFFSET_CIRCUIT);
                        break;
                    case 'sprint':
                        $data = unpack('iwins/iloses/idisconnects/iREP/iavgOppREP/iavgOppRating', $record, static::OFFSET_SPRINT);
                        break;
                    case 'drag':
                        $data = unpack('iwins/iloses/idisconnects/iREP/iavgOppREP/iavgOppRating', $record, static::OFFSET_DRAG);
                        break;
                    case 'drift':
                        $data = unpack('iwins/iloses/idisconnects/iREP/iavgOppREP/iavgOppRating', $record, static::OFFSET_DRIFT);
                        break;
                    default:
                        $data = unpack('iwins/iloses/idisconnects/iREP/iavgOppREP/iavgOppRating', $record, static::OFFSET_OVERALL);
                        break;
                }

                $data['name'] = substr(substr($record, 0, 16), 0, strpos(substr($record, 0, 16), "\x0"));

                $data['winsPercent'] = ($data['wins'] + $data['loses'] + $data['disconnects']) == 0
                    ? '0%'
                    : round($data['wins'] / ($data['wins'] + $data['loses'] + $data['disconnects']) * 100) . '%';
                $data['disconnectsPercent'] = ($data['wins'] + $data['loses'] + $data['disconnects']) == 0
                    ? '0%'
                    : round($data['disconnects'] / ($data['wins'] + $data['loses'] + $data['disconnects']) * 100) . '%';

                return $data;
            })->sortByDesc('REP');
    }
}
