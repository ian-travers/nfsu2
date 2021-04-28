<?php

namespace App\Http\Controllers;

use App\Models\NFSUServer\BestPerformers;
use App\Models\NFSUServer\RealServer;
use App\Models\NFSUServer\SpecificGameData;
use DomainException;

class NFSUServerController extends Controller
{
    protected array $types = ['circuit', 'sprint', 'drag', 'drift'];

    public function monitor()
    {
        return view('frontend.server.monitor', [
            'serverInfo' => new RealServer(config('nfsu-server.ip'), config('nfsu-server.port')),
            'title' => __('Server monitor')
        ]);
    }

    /**
     * @throws \Exception
     */
    public function bestPerformers(string $type, string $track)
    {
        if (!in_array($type, $this->types)) {
            return back()->with('status', [
                'type' => 'error',
                'message' => __('Invalid track mode.'),
            ]);
        }

        $sgd = new SpecificGameData();

        if (!$sgd->isTrackTypeValid($track, $type)) {
            return back()->with('status', [
                'type' => 'warning',
                'message' => __('Incorrect combination of race mode and track.'),
            ]);
        }

        try {
            $bp = new BestPerformers(config('nfsu-server.path'), $track);
        } catch (DomainException $e) {
            return back()->with('status', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        $track = $sgd->trackName($track);

        return view('frontend.server.best-performers', [
            'type' => ucfirst($type),
            'track' => $track,
            'modes' => $sgd->modes(),
            'rating' => $bp->rating(),
            'title' => __('Best Performers') . ' | ' . $track,
        ]);
    }
}
