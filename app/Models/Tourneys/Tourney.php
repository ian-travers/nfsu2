<?php

namespace App\Models\Tourneys;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourneys\Tourney
 *
 * @property int $id
 * @property string $name
 * @property string $track_id
 * @property string $room
 * @property string $started_at
 * @property int $signup_time
 * @property int|null $supervisor_id
 * @property string $supervisor_username
 * @property string $status
 * @property int $season_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Tourney newModelQuery()
 * @method static Builder|Tourney newQuery()
 * @method static Builder|Tourney query()
 * @method static Builder|Tourney whereCreatedAt($value)
 * @method static Builder|Tourney whereId($value)
 * @method static Builder|Tourney whereName($value)
 * @method static Builder|Tourney whereRoom($value)
 * @method static Builder|Tourney whereSeasonId($value)
 * @method static Builder|Tourney whereSignupTime($value)
 * @method static Builder|Tourney whereStartedAt($value)
 * @method static Builder|Tourney whereStatus($value)
 * @method static Builder|Tourney whereSupervisorId($value)
 * @method static Builder|Tourney whereSupervisorUsername($value)
 * @method static Builder|Tourney whereTrackId($value)
 * @method static Builder|Tourney whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tourney extends Model
{
}
