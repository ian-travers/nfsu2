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
 * @method static \Database\Factories\Tourney\TourneyDetailFactory factory(...$parameters)
 * @method static Builder|TourneyDetail newModelQuery()
 * @method static Builder|TourneyDetail newQuery()
 * @method static Builder|TourneyDetail query()
 * @method static Builder|TourneyDetail whereId($value)
 * @method static Builder|TourneyDetail wherePts($value)
 * @method static Builder|TourneyDetail whereRacerId($value)
 * @method static Builder|TourneyDetail whereRacerUsername($value)
 * @method static Builder|TourneyDetail whereSignedAt($value)
 * @method static Builder|TourneyDetail whereTourneyId($value)
 * @mixin \Eloquent
 */
class TourneyDetail extends Model
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
        return $this->belongsTo(User::class, 'racer_id')->withTrashed();
    }
}
