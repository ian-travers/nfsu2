<?php

namespace App\Models\Tourney;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourney\Tourney
 *
 * @property int $id
 * @property string $name
 * @property string $track_id
 * @property string $room
 * @property \Illuminate\Support\Carbon $started_at
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
    use HasFactory;

    protected $guarded = [];

    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_DRAW = 'draw';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_FINAL = 'final';
    public const STATUS_PASSED = 'passed';
    public const STATUS_CANCELLED = 'cancelled';

    public static function statuses(): array
    {
        return [
            self::STATUS_SCHEDULED => __('Scheduled'),
            self::STATUS_DRAW => __('Draw'),
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_FINAL => __('Final'),
            self::STATUS_PASSED => __('Passed'),
            self::STATUS_CANCELLED => __('Cancelled'),
        ];
    }

    protected $dates = ['started_at'];

    public function isScheduled(): bool
    {
        return $this->status === self::STATUS_SCHEDULED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isDeletable(): bool
    {
        return $this->isScheduled() || $this->isCancelled();
    }
}
