<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\RacerTestSettings;

class SettingsController extends Controller
{
    public function updateRacerTestSettings()
    {

        request()->validate([
            'questions_count' => 'required|integer|min:6|max:15',
            'allowed_errors_count' => 'required|integer|min:0|max:3',
        ]);

        $settings = app(RacerTestSettings::class);
        $settings->questions_count = (int)request('questions_count');
        $settings->allowed_errors_count = (int)request('allowed_errors_count');

        $settings->save();

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => 'Saved.',
        ]);
    }
}
