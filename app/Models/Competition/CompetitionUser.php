<?php

namespace App\Models\Competition;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Competition\CompetitionUser
 *
 * @property int $id
 * @property int $competition_id
 * @property int $place
 * @property string $username
 * @property string $car
 * @property string $result
 * @property int $pts
 * @property-read \App\Models\Competition\Competition $competition
 * @method static \Database\Factories\Competition\CompetitionUserFactory factory(...$parameters)
 * @method static Builder|CompetitionUser newModelQuery()
 * @method static Builder|CompetitionUser newQuery()
 * @method static Builder|CompetitionUser query()
 * @method static Builder|CompetitionUser whereCar($value)
 * @method static Builder|CompetitionUser whereCompetitionId($value)
 * @method static Builder|CompetitionUser whereId($value)
 * @method static Builder|CompetitionUser wherePlace($value)
 * @method static Builder|CompetitionUser wherePts($value)
 * @method static Builder|CompetitionUser whereResult($value)
 * @method static Builder|CompetitionUser whereUsername($value)
 * @mixin \Eloquent
 */
class CompetitionUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
