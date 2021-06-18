<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tourneys\Season;

class SeasonsController extends Controller
{
    public function index()
    {
        return view('backend.seasons.index', [
            'seasons' => Season::all(),
            'title' => __('Seasons'),
        ]);
    }

    /**
     * @param \App\Models\Tourneys\Season $season
     * @return \Illuminate\Http\RedirectResponse
     * @throws \DomainException|\Throwable
     */
    public function complete(Season $season)
    {
        try {
            $season->complete();
        } catch (\DomainException $e) {
            return back()->with('flash', [
                'type' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Season has been completed'),
        ]);
    }
}
