<?php

namespace App\Http\Controllers;

use App\Models\Tourney\Tourney;
use App\Models\Tourney\TourneyDetail;

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

    public function signup(Tourney $tourney)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->isRacer()) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __('You have no right to sign up the tourney. You must pass the racer test first.'),
            ]);
        }

        if ($user->isSigned($tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'warning',
                'message' => __('You may sign up only once.'),
            ]);
        }

        TourneyDetail::create([
            'tourney_id' => $tourney->id,
            'racer_id' => $user->id,
            'racer_username' => $user->username,
        ]);

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => __('You have been signed up the tourney.'),
        ]);
    }
}
