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

    public function draw(Tourney $tourney)
    {
        try {
            $tourney->draw();
        } catch (DomainException $e) {
            return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
            'type' => 'success',
            'message' => __('Random draw has been done.'),
        ]);
    }

    public function start(Tourney $tourney)
    {
        try {
            $tourney->start();
        } catch (DomainException $e) {
            return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
            'type' => 'success',
            'message' => __('Tourney has been started. You may wait for a couple of minutes and announce the first round.'),
        ]);
    }

    public function final(Tourney $tourney)
    {
        try {
            $tourney->final();
        } catch (DomainException $e) {
            return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
            'type' => 'success',
            'message' => __('The final round may be started. You may wait for a minute and announce the final round.'),
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

    public function complete(Tourney $tourney)
    {
        try {
            $tourney->complete();
        } catch (DomainException $e) {
            return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('cabinet.tourneys.handle.index', $tourney)->with('flash', [
            'type' => 'success',
            'message' => $tourney->isCancelled() ? __('Tourney has been cancelled.') : __('Tourney has been completed.'),
        ]);
    }
}
