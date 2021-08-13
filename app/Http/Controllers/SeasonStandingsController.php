<?php

namespace App\Http\Controllers;

use App\ReadRepositories\SeasonHelper;

class SeasonStandingsController extends Controller
{
    public function personal()
    {
        return view('frontend.season-standings.personal', [
            'title' => __('Personal standings'),
            'types' => SeasonHelper::types(),
            'countries' => SeasonHelper::countries(),
            'teams' => SeasonHelper::teams(),
            'racers' => SeasonHelper::racersStanding(request(['type', 'country', 'team'])),
        ]);
    }

    public function countries()
    {
        return view('frontend.season-standings.countries', [
            'title' => __('Countries standing'),
            'types' => SeasonHelper::types(),
            'countries' => SeasonHelper::countriesStanding(request(['type'])),
        ]);
    }

    public function teams()
    {
        return view('frontend.season-standings.teams', [
            'title' => __('Teams standing'),
            'types' => SeasonHelper::types(),
            'teams' => SeasonHelper::teamsStanding(request(['type'])),
        ]);
    }
}
