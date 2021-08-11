<?php

namespace App\Http\Controllers;

use App\Helpers\SeasonHelper;

class SeasonStandingsController extends Controller
{
    public function personal()
    {
        return view('frontend.season-standings.personal', [
            'title' => __('Personal standings'),
            'types' => SeasonHelper::types(),
            'countries' => SeasonHelper::countries(),
            'teams' => SeasonHelper::teams(),
            'racers' => SeasonHelper::racers(request(['type', 'country', 'team'])),
        ]);
    }

    public function countries()
    {
        //
    }

    public function teams()
    {
        //
    }
}
