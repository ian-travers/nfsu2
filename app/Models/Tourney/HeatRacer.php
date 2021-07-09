<?php

namespace App\Models\Tourney;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourney\HeatRacer
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $heat_id
 * @property int $order
 * @property string $racer_username
 * @property int $place
 * @property int $pts
 * @property-read \App\Models\Tourney\Heat $heat
 * @method static Builder|HeatRacer newModelQuery()
 * @method static Builder|HeatRacer newQuery()
 * @method static Builder|HeatRacer query()
 * @method static Builder|HeatRacer whereHeatId($value)
 * @method static Builder|HeatRacer whereId($value)
 * @method static Builder|HeatRacer whereOrder($value)
 * @method static Builder|HeatRacer wherePlace($value)
 * @method static Builder|HeatRacer wherePts($value)
 * @method static Builder|HeatRacer whereRacerUsername($value)
 * @method static Builder|HeatRacer whereUserId($value)
 * @mixin \Eloquent
 */
class HeatRacer extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function heat()
    {
        return $this->belongsTo(Heat::class);
    }
}
