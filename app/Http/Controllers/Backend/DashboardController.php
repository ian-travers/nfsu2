<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Settings\RacerTestSettings;

class DashboardController extends Controller
{
    public function show()
    {
        return view('backend.dashboard', [
            'racerTestSettings' => app(RacerTestSettings::class),
            'title' => __('Dashboard')
        ]);
    }
}
