<?php

namespace App\Http\Controllers;

use App\Models\NFSUServer\BestPerformers;
use App\Models\NFSUServer\Ratings;
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

    public function bestPerformersRedirect()
    {
        return redirect()->route('server.best-performers', ['circuit', '1001']);
    }

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

    public function ratingsRedirect()
    {
        return redirect()->route('server.ratings', 'overall');
    }

    public function ratings(string $type)
    {
        try {
            $ratings = new Ratings(config('nfsu-server.path') . '/stat.dat');
        } catch (DomainException $e) {
            return back()->with('status', [
                'type' => 'error',
                'message' => __('Can not connect to the NFSU server live data.')
            ]);
        }

        switch ($type) {
            case 'overall':
                $ranking = $ratings->overall()->take(Ratings::RATINGS_LIMIT)->paginate(Ratings::PAGINATION_PER_PAGE);
                break;
            case 'circuit':
                $ranking = $ratings->circuit()->take(Ratings::RATINGS_LIMIT)->paginate(Ratings::PAGINATION_PER_PAGE);
                break;
            case 'sprint':
                $ranking = $ratings->sprint()->take(Ratings::RATINGS_LIMIT)->paginate(Ratings::PAGINATION_PER_PAGE);
                break;
            case 'drag':
                $ranking = $ratings->drag()->take(Ratings::RATINGS_LIMIT)->paginate(Ratings::PAGINATION_PER_PAGE);
                break;
            case 'drift':
                $ranking = $ratings->drift()->take(Ratings::RATINGS_LIMIT)->paginate(Ratings::PAGINATION_PER_PAGE);
                break;
            default:
                return back()->with('status', [
                    'type' => 'error',
                    'message' => __('Invalid ranking type.')
                ]);
        }

        $type = ucfirst($type);
        $title = __('Ranking') . ' | ' . __($type);

        return view('frontend.server.ratings', compact('ranking', 'type', 'title',));
    }
}
