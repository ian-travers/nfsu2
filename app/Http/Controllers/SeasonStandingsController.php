<?php

namespace App\Http\Controllers;

use App\Helpers\SeasonHelper;
use App\Settings\SeasonSettings;

class SeasonStandingsController extends Controller
{
    protected int $seasonIndex;

    public function __construct(int $seasonIndex = null)
    {
        $this->seasonIndex = $seasonIndex ?: app(SeasonSettings::class)->index;
    }

    public function personal()
    {
//        $racers =  SeasonRacer::with('user')
//            ->where('season_index', $this->seasonIndex)
//            ->orderByDesc(DB::raw('circuit_pts + sprint_pts + drag_pts + drift_pts'))
//            ->get();

        return view('frontend.season-standings.personal', [
            'title' => __('Personal standings'),
            'types' => SeasonHelper::types(),
            'countries' => SeasonHelper::countries(),
            'teams' => SeasonHelper::teams(),
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
