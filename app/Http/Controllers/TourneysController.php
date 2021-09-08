<?php

namespace App\Http\Controllers;

use App\Models\Tourney\Tourney;

class TourneysController extends Controller
{
    public function index()
    {
        $all = Tourney::currentSeason()->latest('started_at')->get();

        $tourneys = $all->reject(function ($tourney) {
            return $tourney->isFeatured();
        });

        return view('frontend.tourneys.index', [
            'tourneys' => $tourneys,
            'featuredTourneys' => $all->diff($tourneys),
            'title' => __('Tourneys'),
        ]);
    }

    public function show(Tourney $tourney)
    {
        return view('frontend.tourneys.show', [
           'tourney' => $tourney,
           'title' => $tourney->name,
        ]);
    }

    public function archive()
    {
        return view('frontend.tourneys.archive', [
            'tourneys' => Tourney::archive()->latest('started_at')->get(),
            'title' => __('Tourney archive'),
        ]);
    }
}
