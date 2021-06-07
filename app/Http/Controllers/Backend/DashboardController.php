<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show()
    {
        return view('backend.dashboard', ['title' => __('Dashboard')]);
    }
}
