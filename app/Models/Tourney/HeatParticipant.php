<?php

namespace App\Models\Tourney;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourney\HeatParticipant
 *
 * @property int $id
 * @property int|null $racer_id
 * @property int $heat_id
 * @property int $order
 * @property string $racer_username
 * @property int $place
 * @property int $pts
 * @property-read \App\Models\Tourney\Heat $heat
 * @method static Builder|HeatParticipant newModelQuery()
 * @method static Builder|HeatParticipant newQuery()
 * @method static Builder|HeatParticipant query()
 * @method static Builder|HeatParticipant whereHeatId($value)
 * @method static Builder|HeatParticipant whereId($value)
 * @method static Builder|HeatParticipant whereOrder($value)
 * @method static Builder|HeatParticipant wherePlace($value)
 * @method static Builder|HeatParticipant wherePts($value)
 * @method static Builder|HeatParticipant whereRacerId($value)
 * @method static Builder|HeatParticipant whereRacerUsername($value)
 * @mixin \Eloquent
 */
class HeatParticipant extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function heat()
    {
        return $this->belongsTo(Heat::class);
    }
}
