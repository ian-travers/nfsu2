<?php

namespace App\Models\NFSUServer;

class SpecificGameData
{
    protected array $directions = [
        'forward',
        'reverse',
    ];

    protected array $cars = [
        'WV Golf GTI',
        'Ford Focus',
        'Mazda Miata MX-5',
        'Dodge Neon',
        'Honda Civic',
        'Peugeot 206',
        'Toyota Celica',
        'Mitsubishi Eclipse',
        'Mazda RX-7',
        'Toyota Supra',
        'Honda S2000',
        'Acura RSX',
        'Subaru Impreza',
        'Mitsubishi Lancer',
        'Acura Integra TypeR',
        'Hyundai Tiburon GT',
        'Nissan 350Z',
        'Nissan Sentra SER',
        'Nissan 240SX',
        'Nissan Skyline GTR',
    ];

    protected array $tracks = [
        '1001' => 'Market Street',
        '1002' => 'Stadium',
        '1003' => 'Olympic Square',
        '1004' => 'Terminal',
        '1005' => 'Atlantica',
        '1006' => 'Inner City',
        '1007' => 'Port Royal',
        '1008' => 'National Rail',
        '1102' => 'Liberty Gardens',
        '1103' => 'Broadway',
        '1104' => 'Lock Up',
        '1105' => '9th Frey',
        '1106' => 'Bedard Bridge',
        '1107' => 'Spillway',
        '1108' => '1st Ave. Truck Stop',
        '1109' => '7th Sparling',
        '1201' => '14th and Vine Construction',
        '1202' => 'Highway 1',
        '1206' => 'Main Street',
        '1207' => 'Commercial',
        '1210' => '14th and Vine',
        '1214' => 'Main Street Construction',
        '1301' => 'Drift Track 1',
        '1302' => 'Drift Track 2',
        '1303' => 'Drift Track 3',
        '1304' => 'Drift Track 4',
        '1305' => 'Drift Track 5',
        '1306' => 'Drift Track 6',
        '1307' => 'Drift Track 7',
        '1308' => 'Drift Track 8',
    ];

    public function directions(): array
    {
        return cache()->rememberForever('server.directions', fn() => $this->directions);
    }

    public function cars(): array
    {
        return cache()->rememberForever('server.cars', fn() => $this->cars);
    }

    public function tracks(): array
    {
        return cache()->rememberForever('server.tracks', fn() => $this->tracks);
    }

    public function trackName(string $index): string
    {
        return array_key_exists($index, $this->tracks)
            ? $this->tracks[$index]
            : 'Unknown track';
    }

    public function tracksCircuit(): array
    {
        return cache()->rememberForever('server.tracks.circuit', fn() => array_slice($this->tracks, 0, 8, true));
    }

    public function tracksSprint(): array
    {
        return cache()->rememberForever('server.tracks.sprint', fn() => array_slice($this->tracks, 8, 8, true));
    }

    public function tracksDrag(): array
    {
        return cache()->rememberForever('server.tracks.drag', fn() => array_slice($this->tracks, 16, 6, true));
    }

    public function tracksDrift(): array
    {
        return cache()->rememberForever('server.tracks.drift', fn() => array_slice($this->tracks, 22, 8, true));
    }

    public function modes(): array
    {
        return cache()->rememberForever('server.modes', fn() => [
            'Circuit' => $this->tracksCircuit(),
            'Sprint' => $this->tracksSprint(),
            'Drag' => $this->tracksDrag(),
            'Drift' => $this->tracksDrift(),
        ]);
    }

    public function isTrackTypeValid(string $track, string $type): bool
    {
        if (strtolower($type) == 'circuit') {
            return in_array($track, array_keys($this->tracksCircuit()));
        }

        if (strtolower($type) == 'sprint') {
            return in_array($track, array_keys($this->tracksSprint()));
        }

        if (strtolower($type) == 'drag') {
            return in_array($track, array_keys($this->tracksDrag()));
        }

        if (strtolower($type) == 'drift') {
            return in_array($track, array_keys($this->tracksDrift()));
        }

        return false;
    }

    public static function allCircuits(): array
    {
        $sgd = new self();

        foreach ($sgd->tracksCircuit() as $key => $value) {
            $res[$key . '0'] = $value; // Forward tracks
        }

        foreach ($sgd->tracksCircuit() as $key => $value) {
            $res[$key . '1'] = $value . ' Reverse'; // Reverse tracks
        }

        return $res ?? [];
    }

    public static function allSprints(): array
    {
        $sgd = new self();

        foreach ($sgd->tracksSprint() as $key => $value) {
            $res[$key . '0'] = $value; // Forward tracks
        }

        foreach ($sgd->tracksSprint() as $key => $value) {
            $res[$key . '1'] = $value . ' Reverse'; // Reverse tracks
        }

        return $res ?? [];
    }

    public static function allDrags(): array
    {
        $sgd = new self();

        foreach ($sgd->tracksDrag() as $key => $value) {
            $res[$key . '0'] = $value; // Forward tracks
        }

        foreach ($sgd->tracksDrag() as $key => $value) {
            $res[$key . '1'] = $value . ' Reverse'; // Reverse tracks
        }

        return $res ?? [];

    }

    public static function allDrifts(): array
    {
        $sgd = new self();

        foreach ($sgd->tracksDrift() as $key => $value) {
            $res[$key . '0'] = $value; // Forward tracks
        }

        return $res ?? [];
    }

    public static function getTrackName(string $id)
    {
        $res = (new SpecificGameData)->tracks()[substr($id, 0, 4)];

        return substr($id, 4, 1) == '1'
            ? $res . ' Reverse'
            : $res;
    }
}
