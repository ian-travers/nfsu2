<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Tourney\Tourney;

class HandleTourneyController extends Controller
{
    public function index(Tourney $tourney)
    {
        return view('frontend.user.cabinet.handle-tourney.index', [
            'tourney' => $tourney,
            'title' => __('Handle tourney'),
        ]);
    }

    public function draw(Tourney $tourney)
    {
        try {
            $tourney->draw();
        } catch (\DomainException $e) {
            return back()->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return $tourney;
    }
}
