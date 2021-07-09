<?php

namespace App\Models\Tourney;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourney\Heat
 *
 * @property int $id
 * @property int $tourney_id
 * @property int $round
 * @property int $heat_no
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tourney\HeatRacer[] $participants
 * @property-read int|null $participants_count
 * @method static Builder|Heat newModelQuery()
 * @method static Builder|Heat newQuery()
 * @method static Builder|Heat query()
 * @method static Builder|Heat whereHeatNo($value)
 * @method static Builder|Heat whereId($value)
 * @method static Builder|Heat whereRound($value)
 * @method static Builder|Heat whereTourneyId($value)
 * @mixin \Eloquent
 */
class Heat extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function racers()
    {
        return $this->hasMany(HeatRacer::class);
    }
}
