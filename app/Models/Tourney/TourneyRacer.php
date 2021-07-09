<?php

namespace App\Models\Tourney;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourney\TourneyDetail
 *
 * @property int $id
 * @property int|null $racer_id
 * @property string $racer_username
 * @property int $tourney_id
 * @property int $pts
 * @property \Illuminate\Support\Carbon $signed_at
 * @property-read User|null $racer
 * @property-read \App\Models\Tourney\Tourney $tourney
 * @method static \Database\Factories\Tourney\TourneyRacerFactory factory(...$parameters)
 * @method static Builder|TourneyRacer newModelQuery()
 * @method static Builder|TourneyRacer newQuery()
 * @method static Builder|TourneyRacer query()
 * @method static Builder|TourneyRacer whereId($value)
 * @method static Builder|TourneyRacer wherePts($value)
 * @method static Builder|TourneyRacer whereRacerId($value)
 * @method static Builder|TourneyRacer whereRacerUsername($value)
 * @method static Builder|TourneyRacer whereSignedAt($value)
 * @method static Builder|TourneyRacer whereTourneyId($value)
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

    public function racer()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
