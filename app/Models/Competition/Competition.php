<?php

namespace App\Models\Competition;

use App\Events\CompetitionCompleted;
use App\Models\NFSUServer\BestPerformers;
use App\Models\NFSUServer\SpecificGameData;
use App\Settings\SeasonSettings;
use DomainException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
        return $this->ended_at < now() && !$this->isCompleted();
    }

    public function complete(): void
    {
        throw_if(app(SeasonSettings::class)->suspend, new DomainException(__('Season is suspended.')));
        throw_if($this->isCompleted(), new DomainException(__('Competition is already completed.')));

        event(new CompetitionCompleted($this));

        $this->update(['is_completed' => true]);
    }

    public function tracksCount(): int
    {
        $result = 1;

        if ($this->track2_id) {
            $result++;
        }

        if ($this->track3_id) {
            $result++;
        }

        if ($this->track4_id) {
            $result++;
        }

        return $result;
    }

    public function ratings(): Collection
    {
        $result = collect([]);

        for ($i = 1; $i <= 2; $i++) {
            $field = "track{$i}_id";

            if (isset($this->$field)) {
                $trackName = SpecificGameData::getTrackName($this->$field);
                $rating = $this->getRating($i);

                $result[$trackName] = $rating;
            }
        }

        return $result;
    }

    protected function getRating($index): ?Collection
    {
        $field = "track{$index}_id";

        $direction = Str::substr($this->$field, 4, 1) == '0' ? 'forward' : 'reverse';

        $rating = (new BestPerformers(config('nfsu-server.path'), Str::substr($this->$field, 0, 4)))
            ->rating()
            ->filter(fn($value) => $value['direction'] == $direction && \App\Models\User::existsByUsername($value['name']))
            ->values();

        $result = collect();

        $rating->map(function ($racer, $key) use ($result) {
            $place = $key + 1;

            // Check for equals result and set the same place
            if ($key >= 1) {
                $previous = $result->skip($key - 1)->first();

                if ($racer['resultForHumans'] == $previous['result']) {
                    $place = $previous['place'];
                }
            }

            $item = [
                'place' => $place,
                'username' => $racer['name'],
                'car' => $racer['car'],
                'result' => $racer['resultForHumans'],
                'competition_pts' => intdiv(203 - log($place, 60) * (80 - $place) - $place * 3, 1),
            ];

            $result->push($item);
        });

        return $result;
    }

    public static function hasActive(): bool
    {
        return (bool)self::where('is_completed', false)->count();
    }

    public static function active(): ?self
    {
        return self::where('is_completed', false)->where('season_index', app(SeasonSettings::class)->index)->first();
    }
}
