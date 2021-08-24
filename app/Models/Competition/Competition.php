<?php

namespace App\Models\Competition;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Competition\Competition
 *
 * @property int $id
 * @property bool $is_completed
 * @property string $track1_id
 * @property string|null $track2_id
 * @property string|null $track3_id
 * @property string|null $track4_id
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon $ended_at
 * @method static \Database\Factories\Competition\CompetitionFactory factory(...$parameters)
 * @method static Builder|Competition newModelQuery()
 * @method static Builder|Competition newQuery()
 * @method static Builder|Competition query()
 * @method static Builder|Competition whereEndedAt($value)
 * @method static Builder|Competition whereId($value)
 * @method static Builder|Competition whereIsCompleted($value)
 * @method static Builder|Competition whereStartedAt($value)
 * @method static Builder|Competition whereTrack1Id($value)
 * @method static Builder|Competition whereTrack2Id($value)
 * @method static Builder|Competition whereTrack3Id($value)
 * @method static Builder|Competition whereTrack4Id($value)
 * @mixin \Eloquent
 */
class Competition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $dates = ['started_at', 'ended_at'];

    protected $casts = [
        'is_completed' => 'bool',
    ];

    public function isStarted(): bool
    {
        return $this->started_at < now();
    }

    public function isCompleted(): bool
    {
        return (bool)$this->is_completed;
    }

    public function isCompletable(): bool
    {
        return $this->ended_at < now();
    }

    public function complete(): void
    {
        $this->update(['is_completed' => true]);
    }
}
