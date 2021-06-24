<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;

class CabinetController extends Controller
{
    public function index()
    {
        return view('frontend.user.cabinet.index', [
            'title' => __('Cabinet'),
        ]);
    }
}
