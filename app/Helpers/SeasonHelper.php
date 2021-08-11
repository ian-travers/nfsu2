<?php

namespace App\Helpers;

use App\Models\CountriesList;
use App\Models\Tourney\SeasonRacer;
use App\Models\User;
use App\Settings\SeasonSettings;
use Illuminate\Database\Eloquent\Collection;

class SeasonHelper
{
    public static function index()
    {
        return app(SeasonSettings::class)->index;
    }

    public static function racers(array $filters, int $index = null): Collection
    {
        $type = $filters['type'] ?? 'overall';
        $country = $filters['country'] ?? 'all';
        $team = $filters['team'] ?? 'all';

        switch ($type) {
            case 'circuit':
                $pts = 'circuit_pts as pts';
                break;
            case 'sprint':
                $pts = 'sprint_pts as pts';
                break;
            case 'drag':
                $pts = 'drag_pts as pts';
                break;
            case 'drift':
                $pts = 'drift_pts as pts';
                break;
            default:
                $pts = 'circuit_pts + sprint_pts + drag_pts + drift_pts as pts';
        }

        $seasonIndex = $index ?? self::index();

        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = SeasonRacer::selectRaw('id,user_id,' . $pts)->where('season_index', $seasonIndex)->orderByDesc('pts');

        if ($country !== 'all') {
            $query->whereHas('user', fn($query) =>
                $query->where('country', $country)
            );
        }

        if ($team !== 'all') {
            $query->whereHas('user', fn($query) =>
                $query->whereHas('team', fn($query) =>
                    $query->where('clan', $team)
                )
            );
        }

        return $query->orderByDesc('pts')->get();
    }

    public static function types()
    {
        return ['overall', 'circuit', 'sprint', 'drag', 'drift'];
    }

    public static function countries()
    {
        $result['ALL'] = __('All');

        $keys = User::whereIn('id', SeasonRacer::where('season_index', self::index())->pluck('user_id'))->distinct()->pluck('country');

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
