<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Settings\RacerTestSettings;
use App\Settings\ScoringSettings;

class DashboardController extends Controller
{
    public function show()
    {
        return view('backend.dashboard', [
            'racerTestSettings' => app(RacerTestSettings::class),
            'scoringSettings' => app(ScoringSettings::class),
            'title' => __('Dashboard')
        ]);
    }
}
