<?php

namespace App\Models\Competition;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Competition\CompetitionRacer
 *
 * @property int $id
 * @property int $competition_id
 * @property int $place
 * @property string $username
 * @property string $car
 * @property string $result
 * @property int $pts
 * @property-read \App\Models\Competition\Competition $competition
 * @method static \Database\Factories\Competition\CompetitionRacerFactory factory(...$parameters)
 * @method static Builder|CompetitionRacer newModelQuery()
 * @method static Builder|CompetitionRacer newQuery()
 * @method static Builder|CompetitionRacer query()
 * @method static Builder|CompetitionRacer whereCar($value)
 * @method static Builder|CompetitionRacer whereCompetitionId($value)
 * @method static Builder|CompetitionRacer whereId($value)
 * @method static Builder|CompetitionRacer wherePlace($value)
 * @method static Builder|CompetitionRacer wherePts($value)
 * @method static Builder|CompetitionRacer whereResult($value)
 * @method static Builder|CompetitionRacer whereUsername($value)
 * @mixin \Eloquent
 */
class CompetitionRacer extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isPodium(): bool
    {
        return $this->place && $this->place < 4;
    }
}
