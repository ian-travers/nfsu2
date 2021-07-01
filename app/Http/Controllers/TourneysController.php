<?php

namespace App\Http\Controllers;

use App\Models\Tourney\Tourney;

class TourneysController extends Controller
{

    public function index()
    {
        $all = Tourney::currentSeason()->get();

        $tourneys = $all->reject(function ($tourney) {
            return $tourney->isFeatured();
        });

        return view('frontend.tourneys.index', [
            'tourneys' => $tourneys,
            'featuredTourneys' => $all->diff($tourneys),
            'title' => __('Tourneys'),
        ]);
    }
}
