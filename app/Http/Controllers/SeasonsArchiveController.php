<?php

namespace App\Http\Controllers;

use App\ReadRepositories\SeasonHelper;

class SeasonsArchiveController extends Controller
{
    public function index()
    {
        $currentSeason = SeasonHelper::index();

        return view('frontend.seasons-archive.index', [
            'seasons' => $currentSeason > 1 ? range(1, $currentSeason - 1) : [],
            'title' => __('Seasons archive'),
        ]);
    }

    public function show($season)
    {
        return view('frontend.seasons-archive.show', [
            'title' => __('Season archive information'),
            'types' => SeasonHelper::types($season),
            'countries' => SeasonHelper::countries($season),
            'teams' => SeasonHelper::teams($season),
            'tourneyRacers' => SeasonHelper::racersStanding(request(['type', 'country', 'team']), $season),
            'competitionRacers' => SeasonHelper::competitionRacersStanding($season),
            'season' => $season,
        ]);
    }
}
