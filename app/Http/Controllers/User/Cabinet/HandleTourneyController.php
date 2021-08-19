<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Tourney\Tourney;
use DomainException;

class HandleTourneyController extends Controller
{
    public function index(Tourney $tourney)
    {
        return view('frontend.user.cabinet.handle-tourney.index', [
            'tourney' => $tourney,
            'title' => __('Handle tourney'),
        ]);
    }

    public function clearFinalHeat(Tourney $tourney)
    {
        try {
            $tourney->cleanFinalHeat();
        } catch (DomainException $e) {
            return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
            'type' => 'success',
            'message' => __('The final heat has been cleaned.'),
        ]);
    }
}
