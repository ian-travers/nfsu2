<?php

namespace App\ReadRepositories;

use App\Models\Country;
use App\Models\Tourney\SeasonAward;
use App\Models\Tourney\SeasonRacer;
use App\Models\Tourney\Tourney;
use App\Models\Trophy;
use App\Models\User;
use App\Settings\SeasonSettings;
use Illuminate\Database\Eloquent\Collection;

class SeasonHelper
{
    public static function index(int $index = null)
    {
        return $index ?? app(SeasonSettings::class)->index;
    }

    public static function tourneyRacersStanding(array $filters = [], int $seasonIndex = null): Collection
    {
        $type = $filters['type'] ?? 'overall';
        $country = $filters['country'] ?? 'all';
        $team = $filters['team'] ?? 'all';

        [$tourneysCount, $pts] = self::returningValues($type);

        $query = SeasonRacer::with('user')
            ->selectRaw("id,racer_username,user_id,{$tourneysCount} as tourneys_count, {$pts} as pts")
            ->whereRaw("{$tourneysCount} > 0")
            ->where('season_index', self::index($seasonIndex));

        if ($country !== 'all') {
            $query->whereHas('user', fn($query) => $query->where('country', $country));
        }

        if ($team !== 'all') {
            $query->whereHas('user', fn($query) => $query->whereHas('team', fn($query) => $query->where('clan', $team)));
        }

        return $query->orderByDesc('pts')->get();
    }

    public static function trophiesByUserId(int $userId, string $type, int $seasonIndex = null): Collection
    {
        return Trophy::where('user_id', $userId)
            ->where('trophiable_type', $type)
            ->whereHas('trophiable', fn($query) => $query->where('season_index', self::index($seasonIndex)))
            ->get();
    }

    public static function countriesStanding(array $filters, int $seasonIndex = null): Collection
    {
        $type = $filters['type'] ?? 'all';

        [$tourneysCount, $pts] = self::returningValues($type);

        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = SeasonRacer::query()
            ->join('users', 'season_racers.user_id', '=', 'users.id')
            ->selectRaw("users.country,count(users.id) as racers_count,sum({$tourneysCount}) as tourneys_count,sum({$pts}) as pts")
            ->where('season_index', self::index($seasonIndex))
            ->groupBy('users.country');

        return $query->orderByDesc('pts')->get();
    }

    public static function teamsStanding(array $filters, int $seasonIndex = null): Collection
    {
        $type = $filters['type'] ?? 'all';

        [$tourneysCount, $pts] = self::returningValues($type);

        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = SeasonRacer::query()
            ->join('users', 'season_racers.user_id', '=', 'users.id')
            ->join('teams', 'users.team_id', '=', 'teams.id')
            ->selectRaw("teams.clan,teams.name, count(users.id) as racers_count,sum({$tourneysCount}) as tourneys_count,sum({$pts}) as pts")
            ->where('season_index', self::index($seasonIndex))
            ->groupBy('teams.clan');

        return $query->orderByDesc('pts')->get();
    }

    public static function types(int $seasonIndex = null): array
    {
        $typeKeys = Tourney::selectRaw('SUBSTR(track_id, 2, 1) as race_type')
            ->distinct()
            ->where('status', 'completed')
            ->where('season_index', self::index($seasonIndex))
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

    public static function countries(int $seasonIndex = null): array
    {
        $result['ALL'] = __('All');

        $keys = User::whereIn('id', SeasonRacer::where('season_index', self::index($seasonIndex))
            ->pluck('user_id'))
            ->distinct()
            ->pluck('country');

        foreach ($keys as $key) {
            $result[$key] = Country::name($key);
        }

        return $result;
    }

    public static function teams(int $seasonIndex = null): array
    {
        $racers = SeasonRacer::with('user')->where('season_index', self::index($seasonIndex))->get();

        $result['ALL'] = __('All');

        $racers = $racers->filter(function ($racer) {
            return $racer->user ? $racer->user->isTeamMember() : false;
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

    public static function competitionRacersStanding(int $seasonIndex = null)
    {
        return SeasonRacer::with('user')
            ->selectRaw("id,racer_username,user_id,competition_count,competition_pts as pts")
            ->where('competition_count', '>', 0)
            ->where('season_index', self::index($seasonIndex))
            ->orderByDesc('pts')
            ->get();
    }

    public static function rewardWinners(int $seasonIndex = null)
    {
        $winners = [];
        $index = self::index($seasonIndex);

        // overall
        $racers = self::tourneyRacersStanding();
        foreach ($racers as $racer) {
            if ($racer->getPlace($racers) == 1) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'overall',
                    'place' => 1,
                ];
            } elseif ($racer->getPlace($racers) == 2) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'overall',
                    'place' => 2,
                ];
            } elseif ($racer->getPlace($racers) == 3) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'overall',
                    'place' => 3,
                ];
            } else {
                break;
            }
        }

        // circuit
        $racers = self::tourneyRacersStanding(['type' => 'circuit']);
        foreach ($racers as $racer) {
            if ($racer->getPlace($racers) == 1) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'circuit',
                    'place' => 1,
                ];
            } elseif ($racer->getPlace($racers) == 2) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'circuit',
                    'place' => 2,
                ];
            } elseif ($racer->getPlace($racers) == 3) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'circuit',
                    'place' => 3,
                ];
            } else {
                break;
            }
        }

        // sprint
        $racers = self::tourneyRacersStanding(['type' => 'sprint']);
        foreach ($racers as $racer) {
            if ($racer->getPlace($racers) == 1) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'sprint',
                    'place' => 1,
                ];
            } elseif ($racer->getPlace($racers) == 2) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'sprint',
                    'place' => 2,
                ];
            } elseif ($racer->getPlace($racers) == 3) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'sprint',
                    'place' => 3,
                ];
            } else {
                break;
            }
        }

        // drag
        $racers = self::tourneyRacersStanding(['type' => 'drag']);
        foreach ($racers as $racer) {
            if ($racer->getPlace($racers) == 1) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'drag',
                    'place' => 1,
                ];
            } elseif ($racer->getPlace($racers) == 2) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'drag',
                    'place' => 2,
                ];
            } elseif ($racer->getPlace($racers) == 3) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'drag',
                    'place' => 3,
                ];
            } else {
                break;
            }
        }

        // drift
        $racers = self::tourneyRacersStanding(['type' => 'drift']);
        foreach ($racers as $racer) {
            if ($racer->getPlace($racers) == 1) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'drift',
                    'place' => 1,
                ];
            } elseif ($racer->getPlace($racers) == 2) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'drift',
                    'place' => 2,
                ];
            } elseif ($racer->getPlace($racers) == 3) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'drift',
                    'place' => 3,
                ];
            } else {
                break;
            }
        }

        // competition
        $racers = self::competitionRacersStanding();
        foreach ($racers as $racer) {
            if ($racer->getPlace($racers) == 1) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'competition',
                    'place' => 1,
                ];
            } elseif ($racer->getPlace($racers) == 2) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'competition',
                    'place' => 2,
                ];
            } elseif ($racer->getPlace($racers) == 3) {
                $winners[] = [
                    'user_id' => $racer->user_id,
                    'season_index' => $index,
                    'type' => 'competition',
                    'place' => 3,
                ];
            } else {
                break;
            }
        }

        // persist
        SeasonAward::insert($winners);
    }
}
