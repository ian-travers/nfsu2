<?php

namespace App\Models\Tourney;

use App\Models\NFSUServer\SpecificGameData;
use App\Settings\SeasonSettings;
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
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tourney\TourneyDetail[] $details
 * @property-read int|null $details_count
 * @method static Builder|Tourney currentSeason()
 * @method static \Database\Factories\Tourney\TourneyFactory factory(...$parameters)
 * @method static Builder|Tourney newModelQuery()
 * @method static Builder|Tourney newQuery()
 * @method static Builder|Tourney query()
 * @method static Builder|Tourney whereCreatedAt($value)
 * @method static Builder|Tourney whereDescription($value)
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

    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_DRAW = 'draw';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_FINAL = 'final';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public static function statuses(): array
    {
        return [
            self::STATUS_SCHEDULED => __('Scheduled'),
            self::STATUS_DRAW => __('Draw'),
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_FINAL => __('Final'),
            self::STATUS_COMPLETED => __('Completed'),
            self::STATUS_CANCELLED => __('Cancelled'),
        ];
    }

    protected $dates = ['started_at'];

    public function details()
    {
        return $this->hasMany(TourneyDetail::class);
    }

    public function isScheduled(): bool
    {
        return $this->status === self::STATUS_SCHEDULED;
    }

    public function isDraw(): bool
    {
        return $this->status === self::STATUS_DRAW;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isDeletable(): bool
    {
        return $this->isScheduled() || $this->isCancelled();
    }

    public function status()
    {
        return static::statuses()[$this->status];
    }

    public function type(): string
    {
        switch (substr($this->track_id, 1, 1)) {
            case '0':
                return 'circuit';
            case '1':
                return 'sprint';
            case '2':
                return 'drag';
            case '3':
                return 'drift';
            default:
                return 'unknown type';
        }
    }

    public function isSigningUp(): bool
    {
        $offset = $this->started_at->diffInMinutes(now(), false);

        return ($offset < 0) && (($offset + $this->signup_time) >= 0);
    }

    public function isFeatured(): bool
    {
        return $this->isSigningUp() || $this->status === self::STATUS_DRAW || $this->status === self::STATUS_ACTIVE || $this->status === self::STATUS_FINAL;
    }

    public function trackName()
    {
        return SpecificGameData::getTrackName($this->track_id);
    }

    public function scopeCurrentSeason($query)
    {
        return $query->where('season_id', app(SeasonSettings::class)->index);
    }

    public function heats()
    {
        return $this->hasMany(Heat::class);
    }

    /**
     * @throws \Throwable
     */
    public function draw()
    {
        $participantCount = $this->details()->count();

        throw_unless($this->supervisor_id == auth()->id(), new \DomainException(__("Unable to draw someone's else tourney.")));
        throw_if($participantCount < 2, new \DomainException(__('Too few racers. You should complete the tourney now.')));


        $heatsPerRound = (int)ceil($participantCount / 4);

        $this->createAllHeats($heatsPerRound);

        $participants = $this->details->shuffle();

        $fours = intdiv($participantCount, 4);
        $remainder = $participantCount % 4;
    }

    protected function createAllHeats(int $heatsPerRound): void
    {
        for ($round = 1; $round <= 4; $round++) {
            for ($heatNo = 1; $heatNo <= $heatsPerRound; $heatNo++) {
                $this->heats()->create([
                    'round' => $round,
                    'heat_no' => $heatNo,
                ]);
            }
        }

        $this->heats()->create([
            'round' => 5,
            'heat_no' => 1,
        ]);
    }
}
