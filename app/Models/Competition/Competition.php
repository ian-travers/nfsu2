<?php

namespace App\Models\Competition;

use App\Events\CompetitionCompleted;
use App\Models\News;
use App\Models\NFSUServer\BestPerformers;
use App\Models\NFSUServer\SpecificGameData;
use App\Models\Trophy;
use App\Models\User;
use App\Notifications\CompetitionWasCreated;
use App\Notifications\CompetitionWasCreatedEmail;
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
 * @property int $season_index
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Competition\CompetitionRacer[] $racers
 * @property-read int|null $racers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Trophy[] $trophies
 * @property-read int|null $trophies_count
 * @method static \Database\Factories\Competition\CompetitionFactory factory(...$parameters)
 * @method static Builder|Competition newModelQuery()
 * @method static Builder|Competition newQuery()
 * @method static Builder|Competition passed()
 * @method static Builder|Competition query()
 * @method static Builder|Competition whereEndedAt($value)
 * @method static Builder|Competition whereId($value)
 * @method static Builder|Competition whereIsCompleted($value)
 * @method static Builder|Competition whereSeasonIndex($value)
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

    protected static function boot()
    {
        parent::boot();

        static::created(function($model) {
            $model->notifyAllUsers($model);

            $attributes = [
                'title_en' => "New competition is available",
                'title_ru' => "Доступно новое состязание",
                'body_en' => "A new active competition has appeared, according to preliminary information it will be held from {$model->started_at->locale('en_US')->isoFormat('l')} to {$model->ended_at->locale('en_US')->isoFormat('l')}. The position of the players and the tracks can be found on the \"Competition\" page.",
                'body_ru' => "Появилось новое активное состязание, по предварительной информации оно будет проходить с {$model->started_at->locale('ru_RU')->isoFormat('l')} по {$model->ended_at->locale('ru_RU')->isoFormat('l')}. Положение игроков и трассы можно найти на странице \"Состязание\" .",
                'status' => 1,
            ];

            News::create($attributes);
        });
    }

    public function frontendPath(): string
    {
        return "/competitions/{$this->id}";
    }

    public function racers()
    {
        return $this->hasMany(CompetitionRacer::class)->orderByDesc('pts');
    }

    public function trophies()
    {
        return $this->morphMany(Trophy::class, 'trophiable');
    }

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

    public function standing(): Collection
    {
        if ($this->isCompleted()) {
            return $this->racers;
        }

        $allRacer = collect();

        foreach ($this->ratingsPerTrack() as $trackName => $rating) {
            foreach ($rating as $racer) {
                $existing = $allRacer->first(fn($item) => $item['user_id'] == $racer['user_id']);

                if ($existing) {
                    $existing['result'] .= " | {$trackName} - {$racer['result']}";
                    $existing['pts'] += $racer['pts'];
                    $existing['car'] .= " | {$racer['car']}";
                } else {
                    $allRacer->add(collect([
                        'user_id' => $racer['user_id'],
                        'username' => $racer['username'],
                        'result' => "{$trackName} - {$racer['result']}",
                        'car' => $racer['car'],
                        'pts' => $racer['pts'],
                    ]));
                }
            }
        }

        $result = collect();

        $allRacer->sortByDesc('pts')->values()->map(function ($racer, $key) use ($result) {
            $place = $key + 1;

            if ($key >= 1) {
                $previous = $result->skip($key - 1)->first();

                if ($racer['pts'] == $previous['pts']) {
                    $place = $previous['place'];
                }
            }

            $item = [
                'place' => $place,
                'user_id' => $racer['user_id'],
                'username' => $racer['username'],
                'car' => $racer['car'],
                'result' => $racer['result'],
                'pts' => $racer['pts'],
                'competition_id' => $this->id, // for bulk inserting
            ];

            $result->push($item);
        });

        return $result;
    }

    public function ratingsPerTrack(): Collection
    {
        $result = collect();

        for ($i = 1; $i <= 4; $i++) {
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
            ->filter(fn($value) => $value['direction'] == $direction && User::existsByUsername($value['name']))
            ->values()
            ->transform(function ($racer) {
                return collect($racer)->put('user_id', User::where('username', $racer['name'])->first()->id);
            });

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
                'user_id' => $racer['user_id'],
                'username' => $racer['name'],
                'car' => $racer['car'],
                'result' => $racer['resultForHumans'],
                'pts' => intdiv(203 - log($place, 60) * (80 - $place) - $place * 3, $this->tracksCount()),
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

    public function scopePassed(Builder $query): Builder
    {
        return $query->where('is_completed', 1);
    }

    public function notifyAllUsers(self $competition): void
    {
        User::allBrowserNotified()
            ->each->notify(new CompetitionWasCreated($competition));

        User::allEmailNotified()
            ->each->notify(new CompetitionWasCreatedEmail($competition));
    }
}
