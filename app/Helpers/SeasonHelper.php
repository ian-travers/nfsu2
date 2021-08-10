<?php

namespace App\Helpers;

use App\Models\CountriesList;
use App\Models\Tourney\SeasonRacer;
use App\Models\User;
use App\Settings\SeasonSettings;

class SeasonHelper
{
    public static function index()
    {
        return app(SeasonSettings::class)->index;
    }

    public static function types()
    {
        return ['overall', 'circuit', 'sprint', 'drag', 'drift'];
    }

    public static function countries()
    {
        $result['ALL'] = __('All');

        $keys =  User::whereIn('id', SeasonRacer::where('season_index', self::index())->pluck('user_id'))->distinct()->pluck('country');

        foreach ($keys as $key) {
            $result[$key] = CountriesList::all(app()->getLocale())[$key];
        }

        return $result;
    }

    public static function teams()
    {
        $racers = SeasonRacer::with('user')->where('season_index', self::index())->get();

        $result['ALL'] = __('All');

        $racers = $racers->filter(function ($racer) {
            return $racer->user->team;
        });

        foreach ($racers as $racer) {
            $result[$racer->user->team->clan] = $racer->user->team->name;
        }

        return $result;
    }
}
