<?php

namespace App\Models\NFSUServer;

use DomainException;
use Illuminate\Support\Collection;

class BestPerformers extends SpecificGameData
{
    protected string $trackId;
    protected string $filename;

    /**
     * @throws DomainException|\Throwable
     */
    public function __construct(string $path, string $trackId)
    {
        throw_unless(array_key_exists($trackId, $this->tracks()), new DomainException(__('Unknown track')));

        $this->trackId = $trackId;
        $this->filename = "{$path}/s{$trackId}.dat";
    }

    public function isDrift(): bool
    {
        return in_array($this->trackId, array_keys($this->tracksDrift()));
    }

    public function rating(): Collection
    {
        return file_exists($this->filename)
            ? $this->getRating()
            : collect();
    }

    protected function getRating(): Collection
    {
        for ($i = 0; $i < filesize($this->filename); $i += 28) {
            $rawArray[] = file_get_contents($this->filename, null, null, $i, 28);
        }

        $rating = collect($rawArray)
            ->map(function ($record) {
                $name = substr(substr($record, 0, 16), 0, strpos(substr($record, 0, 16), "\x0"));
                $score = hexdec(Helper::str2Hex(substr($record, 16, 4)));
                $resultForHumans = $this->isDrift() ? number_format($score, 0, '', ' ') : $this->toMinSec($score);
                $car = $this->cars[hexdec(Helper::str2Hex(substr($record, 20, 4)))];
                $direction = $this->directions[hexdec(Helper::str2Hex(substr($record, 24, 4)))];

                return compact('name', 'score', 'resultForHumans', 'car', 'direction');
            });

        return $this->isDrift()
            ? $rating->sortByDesc('score')
            : $rating->sortBy('score');
    }

    /**
     * Convert milliseconds to formatted string 'm:s.ms'
     *
     * Examples:
     *      32760 => '32.76'    32 sec 760 msec
     *      94670 => '1:34.67'  1 min 34 sec 670 mesc
     *
     * @param int $milliseconds
     * @return string
     */
    protected function toMinSec(int $milliseconds = 0): string
    {
        $result = ($minutes = floor($milliseconds / 60000))
            ? $minutes . ':'
            : '';

        ($seconds = floor(($milliseconds - ($minutes * 60000)) / 1000)) < 10
            ? $result .= '0' . $seconds . '.'
            : $result .= $seconds . '.';

        ($mseconds = $milliseconds % 1000) < 100
            ? ($mseconds ? $result .= '0' . $mseconds
            : $result .= '000') : $result .= $mseconds;

        return substr($result, 0, strlen($result) - 1);
    }
}
