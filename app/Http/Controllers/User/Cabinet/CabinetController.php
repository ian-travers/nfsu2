<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;

class CabinetController extends Controller
{
    public function index()
    {
        $user = User::withCount(['tourneys'])->find(auth()->id());

        return view('frontend.user.cabinet.index', [
            'title' => __('Cabinet'),
            'user' => $user,
        ]);
    }
}
