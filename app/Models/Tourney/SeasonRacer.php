<?php

namespace App\Models\Tourney;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourney\SeasonRacer
 *
 * @property int $id
 * @property int $user_id
 * @property string $racer_username
 * @property int $season_index
 * @property int $circuit_count
 * @property int $circuit_pts
 * @property int $sprint_count
 * @property int $sprint_pts
 * @property int $drag_count
 * @property int $drag_pts
 * @property int $drift_count
 * @property int $drift_pts
 * @property int $competition_count
 * @property int $competition_pts
 * @property-read mixed $overall_count
 * @property-read mixed $overall_pts
 * @property-read User $user
 * @method static Builder|SeasonRacer newModelQuery()
 * @method static Builder|SeasonRacer newQuery()
 * @method static Builder|SeasonRacer query()
 * @method static Builder|SeasonRacer whereCircuitCount($value)
 * @method static Builder|SeasonRacer whereCircuitPts($value)
 * @method static Builder|SeasonRacer whereCompetitionCount($value)
 * @method static Builder|SeasonRacer whereCompetitionPts($value)
 * @method static Builder|SeasonRacer whereDragCount($value)
 * @method static Builder|SeasonRacer whereDragPts($value)
 * @method static Builder|SeasonRacer whereDriftCount($value)
 * @method static Builder|SeasonRacer whereDriftPts($value)
 * @method static Builder|SeasonRacer whereId($value)
 * @method static Builder|SeasonRacer whereRacerUsername($value)
 * @method static Builder|SeasonRacer whereSeasonIndex($value)
 * @method static Builder|SeasonRacer whereSprintCount($value)
 * @method static Builder|SeasonRacer whereSprintPts($value)
 * @method static Builder|SeasonRacer whereUserId($value)
 * @mixin \Eloquent
 */
class SeasonRacer extends Model
{
    use DetectPlace;

    public $timestamps = false;

    protected $guarded = [];

    protected $attributes = [
        'circuit_count' => 0,
        'circuit_pts' => 0,
        'sprint_count' => 0,
        'sprint_pts' => 0,
        'drag_count' => 0,
        'drag_pts' => 0,
        'drift_count' => 0,
        'drift_pts' => 0,
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->with('team');
    }

    public function incrementStatistics(string $type, int $pts): void
    {
        $field = $type . '_pts';

        $this->increment("{$type}_count", 1, ["{$type}_pts" => $this->$field + $pts]);
    }

    public function getOverallCountAttribute()
    {
        return $this->circuit_count + $this->sprint_count + $this->drag_count + $this->drift_count;
    }

    public function getOverallPtsAttribute()
    {
        return $this->circuit_pts + $this->sprint_pts + $this->drag_pts + $this->drift_pts;
    }

    public function getPlace($racers)
    {
        $place = 0;

        foreach ($racers as $index => $racer) {
            // if any racers have equal pts -> the same place
            $place = $index ? $this->detectPlace($index, $racer->pts, $racers->take($index)) : 1;

            if ($racer->is($this)) {
                break;
            }
        }

        return $place;
    }
}
