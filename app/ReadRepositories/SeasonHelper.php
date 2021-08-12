<?php

namespace App\ReadRepositories;

use App\Models\Country;
use App\Models\Tourney\SeasonRacer;
use App\Models\Tourney\Tourney;
use App\Models\User;
use App\Settings\SeasonSettings;
use Illuminate\Database\Eloquent\Collection;

class SeasonHelper
{
    public static function index(int $index = null)
    {
        return $index ?? app(SeasonSettings::class)->index;
    }

    public static function racersStanding(array $filters, int $index = null): Collection
    {
        $type = $filters['type'] ?? 'overall';
        $country = $filters['country'] ?? 'all';
        $team = $filters['team'] ?? 'all';

        [$tourneysCount, $pts] = self::returningValues($type);

        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = SeasonRacer::selectRaw("id,user_id,{$tourneysCount} as tourneys_count, {$pts} as pts")->where('season_index', self::index($index))->orderByDesc('pts');

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

    public static function countriesStanding(array $filters, int $index = null)
    {
        $type = $filters['type'] ?? 'all';

        [$tourneysCount, $pts] = self::returningValues($type);

        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = SeasonRacer::query()
            ->join('users', 'season_racers.user_id', '=', 'users.id')
            ->selectRaw("users.country, count(users.id) as racers_count,sum({$tourneysCount}) as tourneys_count,sum({$pts}) as pts")
            ->where('season_index', self::index($index))
            ->groupBy('users.country');

        return $query->orderByDesc('pts')->get();
    }

    public static function types(int $index = null)
    {
        $typeKeys = Tourney::selectRaw('SUBSTR(track_id, 2, 1) as race_type')
            ->distinct()
            ->where('status', 'completed')
            ->where('season_id', self::index($index))
            ->get()
            ->pluck('race_type')
            ->toArray();

        $types[] = 'overall';

        if (in_array('0', $typeKeys)) {
            $types[] = 'circuit';
        }

        if (in_array('1', $typeKeys)) {
            $types[] = 'sprint';
        }

        if (in_array('2', $typeKeys)) {
            $types[] = 'drag';
        }

        if (in_array('3', $typeKeys)) {
            $types[] = 'drift';
        }

        return $types;
    }

    public static function countries(int $index = null)
    {
        $result['ALL'] = __('All');

        $keys = User::whereIn('id', SeasonRacer::where('season_index', self::index($index))->pluck('user_id'))->distinct()->pluck('country');

        foreach ($keys as $key) {
            $result[$key] = Country::all()[$key];
        }

        return $result;
    }

    public static function teams(int $index = null)
    {
        $racers = SeasonRacer::with('user')->where('season_index', self::index($index))->get();

        $result['ALL'] = __('All');

        $racers = $racers->filter(function ($racer) {
            return $racer->user->team;
        });

        foreach ($racers as $racer) {
            $result[$racer->user->team->clan] = $racer->user->team->name;
        }

        return $result;
    }

    protected static function returningValues(string $type): array
    {
        if (!($type == 'circuit' || $type == 'sprint' || $type == 'drag' || $type == 'drift')) {
            return [
                'circuit_count + sprint_count + drag_count + drift_count',
                'circuit_pts + sprint_pts + drag_pts + drift_pts'
            ];
        }

        return ["{$type}_count", "{$type}_pts"];
    }
}
