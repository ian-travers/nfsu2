<?php

namespace App\Models\Tourney;

use App\Events\TourneyCompleted;
use App\Models\NFSUServer\SpecificGameData;
use App\Models\Trophy;
use App\Models\User;
use App\Settings\SeasonSettings;
use DomainException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
 * @property int $season_index
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|\App\Models\Tourney\Heat[] $heats
 * @property-read int|null $heats_count
 * @property-read Collection|\App\Models\Tourney\TourneyRacer[] $racers
 * @property-read int|null $racers_count
 * @property-read Collection|Trophy[] $trophies
 * @property-read int|null $trophies_count
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

    public function racers()
    {
        return $this->hasMany(TourneyRacer::class)->orderByDesc('pts');
    }

    public function trophies()
    {
        return $this->morphMany(Trophy::class, 'trophiable');
    }

    public function isScheduled(): bool
    {
        return $this->status === self::STATUS_SCHEDULED;
    }

    public function isDraw(): bool
    {
        return $this->status === self::STATUS_DRAW;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isFinal(): bool
    {
        return $this->status === self::STATUS_FINAL;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isEditable(): bool
    {
        return $this->isScheduled() || $this->isCancelled();
    }

    public function status()
    {
        return static::statuses()[$this->status];
    }

    public function winnerUsername(): string
    {
        return $this->isCompleted() ? $this->racers()->first()->racer_username : '';
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

    public function isCancellable(): bool
    {
        return $this->racers()->count() < 2 && now() > $this->started_at;
    }

    public function trackName()
    {
        return SpecificGameData::getTrackName($this->track_id);
    }

    public function scopeCurrentSeason($query)
    {
        return $query->where('season_index', app(SeasonSettings::class)->index);
    }

    public function heats()
    {
        return $this->hasMany(Heat::class);
    }

    /**
     *  Performs random draw of players by rounds and races
     *
     * @throws DomainException
     */
    public function draw()
    {
        $racersCount = $this->racers()->count();

        throw_unless($this->supervisor_id == auth()->id(), new DomainException(__("Unable to draw someone's else tourney.")));
        throw_if(now() <= $this->started_at, new DomainException(__('Signup period is not over.')));
        throw_if($racersCount < 2, new DomainException(__('Too few racers. You should complete the tourney now. It will become CANCELLED.')));
        throw_unless($this->isScheduled() || $this->isDraw(), new DomainException(__('The start of the tourney has already been announced. No new draw possible.')));

        $heatsPerRound = (int)ceil($racersCount / 4);

        if ($this->isScheduled()) {                     // Tourney is scheduled
            if (!$this->heats()->count()) {             // There are no heats yet
                $this->createAllHeats($heatsPerRound);
            }
        }

        $this->clearHeatsRacers();

        $racers = $this->racers->shuffle();

        $fours = intdiv($racersCount, 4);
        $remainder = $racersCount % 4;

        $this->drawEachHeat($racers, $fours, $remainder);
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

    protected function clearHeatsRacers(): void
    {
        $this->heats->map(function (Heat $heat) {
            $heat->racers()->delete();
        });
    }

    protected function drawEachHeat(Collection $racers, int $fours, int $remainder): bool
    {
        if ($fours == 0 || ($fours == 1 && $remainder == 0)) { // 2-4 participants
            for ($round = 1; $round <= 5; $round++) {
                $racers = $racers->shuffle();
                $this->arrangeHeat($round, 1, $racers);
            }

            return $this->update(['status' => self::STATUS_DRAW]);
        }

        if ($remainder == 0) {                              //  only fours each heat
            for ($round = 1; $round <= 4; $round++) {
                $racers = $racers->shuffle();

                for ($heat = 1; $heat <= $fours; $heat++) {
                    $this->arrangeHeat($round, $heat, $racers->slice(4, 4));
                }
            }

            return $this->update(['status' => self::STATUS_DRAW]);
        }

        for ($round = 1; $round <= 4; $round++) {
            if ($fours == 1) {                          // 5-7 racers
                $medium = ($round % 2)
                    ? ceil($racers->count() / 2)
                    : floor($racers->count() / 2);

                $racers = $racers->shuffle();
                $this->arrangeHeat($round, 1, $racers->slice(0, $medium));
                $this->arrangeHeat($round, 2, $racers->slice($medium));
            } else {                                    // 9+ participants, not a multiple of four
                $racers = $racers->shuffle();
                $offset3 = 0;

                for ($heat = 1; $heat <= (4 - $remainder); $heat++) {
                    $this->arrangeHeat($round, $heat, $racers->slice($offset3 * 3, 3)->values());
                    $offset3++;
                }

                $offset4 = 0;
                for ($heat = 5 - $remainder; $heat <= $fours + 1; $heat++) {
                    $this->arrangeHeat($round, $heat, $racers->slice($offset3 * 3 + $offset4 * 4, 4)->values());
                    $offset4++;
                }
            }
        }

        return $this->update(['status' => self::STATUS_DRAW]);
    }

    protected function arrangeHeat(int $round, int $heatNo, Collection $racers): void
    {
        $heat = Heat::where([
            ['tourney_id', $this->id],
            ['round', $round],
            ['heat_no', $heatNo]
        ])->firstOrCreate([
            'tourney_id' => $this->id,
            'round' => $round,
            'heat_no' => $heatNo
        ]);

        $racers->map(function (TourneyRacer $racer, $key) use ($heat) {
            $heat->racers()->create([
                'user_id' => $racer->user_id,
                'racer_username' => $racer->racer_username,
                'order' => $key + 1,
            ]);
        });
    }

    /**
     * Start the tourney
     *
     * @return bool
     * @throws DomainException
     */
    public function start(): bool
    {
        throw_if($this->isScheduled(), new DomainException(__("You should get tourney's draw first.")));
        throw_if($this->isActive() || $this->isFinal(), new DomainException(__('Tourney is already started.')));
        throw_unless($this->supervisor_id == auth()->id(), new DomainException(__("Unable to draw someone's else tourney.")));

        return $this->update(['status' => self::STATUS_ACTIVE]);
    }

    public function final()
    {
        throw_unless($this->isActive(), new DomainException(__("You can only announce the final round for an active tourney.")));
        throw_unless($this->supervisor_id == auth()->id(), new DomainException(__("Unable to announce the final round someone's else tourney.")));

        /** @var \App\Models\Tourney\Heat $finalHeat */
        $finalHeat = ($this->heats()->where('round', 5)->get())[0];

        $mustBe = $this->racers()->count() >= 4 ? 4 : $this->racers()->count();

        throw_if($finalHeat->racers()->count() < $mustBe, new DomainException(__('Not all possible finalists in the final round.')));

        return $this->update(['status' => self::STATUS_FINAL]);
    }

    public function cleanFinalHeat()
    {
        throw_unless($this->isActive(), new DomainException(__("You can only clean the final round for an active tourney.")));
        throw_if($this->isFinal(), new DomainException(__('Unable to clean the heat. Final round has been announced.')));
        throw_unless($this->supervisor_id == auth()->id(), new DomainException(__("Unable to clean the final round someone's else tourney.")));

        $heat = $this->heats()->where('round', 5)->get()->take(1);

        $heat[0]->racers()->delete();
    }

    public function complete()
    {
        if ($this->isCancellable()) {
            throw_if($this->isCancelled(), new DomainException(__('Tourney is already cancelled.')));

            return $this->update(['status' => self::STATUS_CANCELLED]);
        }

        throw_if($this->isCompleted(), new DomainException(__('Tourney is already completed.')));
        throw_unless($this->isFinal(), new DomainException(__("You can only complete the with final status.")));
        throw_unless($this->supervisor_id == auth()->id(), new DomainException(__("Unable to complete someone's else tourney.")));

        event(new TourneyCompleted($this));

        return $this->update(['status' => self::STATUS_COMPLETED]);
    }

    public static function activeTourneys(): \Illuminate\Support\Collection
    {
        return self::whereIn('status', self::activeStatuses())->get();
    }

    public static function unhandledTourneysFor(User $supervisor): \Illuminate\Support\Collection
    {
        return self::where('supervisor_id', $supervisor->id)->whereNotIn('status', [self::STATUS_COMPLETED, self::STATUS_CANCELLED])->get();
    }

    protected static function activeStatuses(): array
    {
        return [self::STATUS_DRAW, self::STATUS_ACTIVE, self::STATUS_FINAL];
    }
}
