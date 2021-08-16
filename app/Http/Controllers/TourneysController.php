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

        if ($user->isSignedForTourney($tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'warning',
                'message' => __('You may sign up only once.'),
            ]);
        }

        $user->signupTourney($tourney);

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => __('You have been signed up the tourney.'),
        ]);
    }

    public function withdraw(Tourney $tourney)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->isRacer()) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __('You have no right to withdraw yourself from the tourney. You must pass the racer test first.'),
            ]);
        }

        if (!$user->isSignedForTourney($tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'warning',
                'message' => __('You have not signed for the tourney.'),
            ]);
        }

        $user->withdrawTourney($tourney);

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => __('You have been withdrawn from the tourney.'),
        ]);
    }
}
