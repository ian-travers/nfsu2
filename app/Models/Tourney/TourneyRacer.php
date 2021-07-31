<?php

namespace App\Models\Tourney;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Models\Tourney\TourneyRacer
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $racer_username
 * @property int $tourney_id
 * @property int $pts
 * @property \Illuminate\Support\Carbon $signed_at
 * @property-read \App\Models\Tourney\Tourney $tourney
 * @property-read User|null $user
 * @method static \Database\Factories\Tourney\TourneyRacerFactory factory(...$parameters)
 * @method static Builder|TourneyRacer newModelQuery()
 * @method static Builder|TourneyRacer newQuery()
 * @method static Builder|TourneyRacer query()
 * @method static Builder|TourneyRacer whereId($value)
 * @method static Builder|TourneyRacer wherePts($value)
 * @method static Builder|TourneyRacer whereRacerUsername($value)
 * @method static Builder|TourneyRacer whereSignedAt($value)
 * @method static Builder|TourneyRacer whereTourneyId($value)
 * @method static Builder|TourneyRacer whereUserId($value)
 * @mixin \Eloquent
 */
class TourneyRacer extends Model
{
    use HasFactory;

    protected $dates = ['signed_at'];

    public $timestamps = false;

    public function tourney()
    {
        return $this->belongsTo(Tourney::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function updateUserPts($tourneyId, $userId): void
    {
        $tourney = Tourney::findOrFail($tourneyId);

        $pts =  $tourney->heats->sum(function ($heat) use ($userId) {
            return $heat->racers->where('user_id', $userId)->sum('pts');
        });

        self::where('tourney_id', $tourneyId)
            ->where('user_id', $userId)
            ->update(['pts' => $pts]);
    }

    public function getPlaceAttribute(): int
    {
        $tourney = $this->tourney;

        $racers = $tourney->racers;

        $place = 1;

        foreach ($racers as $index => $racer) {
            // if any racers have equal pts -> the same place
            $place = $index ? $this->detectPlace($index, $racer->pts, $racers->take($index)) : 1;

            if ($racer->is($this)) {
                break;
            }
        }

        return $place;
    }

    /**
     * Determines the place of the racer in the collection, sorted in descending order of pts.
     *
     * @param $index
     * @param $pts
     * @param \Illuminate\Support\Collection $racersAbove
     *
     * @return int
     */
    protected function detectPlace($index, $pts, Collection $racersAbove): int
    {
        return $racersAbove->count()
            ? ($pts == $racersAbove->last()->pts
                ? $this->detectPlace($index - 1, $racersAbove->last()->pts, $racersAbove->take($index - 1))
                : ++$index)
            : 1;
    }
}
