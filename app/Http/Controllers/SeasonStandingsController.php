<?php

namespace App\Http\Controllers;

use App\ReadRepositories\SeasonHelper;

class SeasonStandingsController extends Controller
{
    public function tourneyPersonal()
    {
        return view('frontend.season-standings.tourney-personal', [
            'title' => __('Tourney personal standings'),
            'types' => SeasonHelper::types(),
            'countries' => SeasonHelper::countries(),
            'teams' => SeasonHelper::teams(),
            'racers' => SeasonHelper::racersStanding(request(['type', 'country', 'team'])),
        ]);
    }

    public function tourneyCountries()
    {
        return view('frontend.season-standings.tourney-countries', [
            'title' => __('Tourney countries standing'),
            'types' => SeasonHelper::types(),
            'countries' => SeasonHelper::countriesStanding(request(['type'])),
        ]);
    }

    public function tourneyTeam()
    {
        return view('frontend.season-standings.tourney-teams', [
            'title' => __('Tourney teams standing'),
            'types' => SeasonHelper::types(),
            'teams' => SeasonHelper::teamsStanding(request(['type'])),
        ]);
    }

    public function competitionPersonal()
    {
        return view('frontend.season-standings.competition-personal', [
            'title' => __('Competition personal standing'),
            'racers' => SeasonHelper::competitionRacersStanding(),
        ]);
    }
}
