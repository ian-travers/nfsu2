<?php

namespace App\Models\Tourneys;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tourneys\Season
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tourneys\Tourney[] $tourneys
 * @property-read int|null $tourneys_count
 * @method static \Database\Factories\Tourneys\SeasonFactory factory(...$parameters)
 * @method static Builder|Season newModelQuery()
 * @method static Builder|Season newQuery()
 * @method static Builder|Season query()
 * @method static Builder|Season whereId($value)
 * @method static Builder|Season whereName($value)
 * @method static Builder|Season whereStatus($value)
 * @mixin \Eloquent
 */
class Season extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_COMPLETE = 'completed';

    public $timestamps = false;

    protected $guarded = [];

    public function tourneys()
    {
        return $this->hasMany(Tourney::class);
    }

    public static function create(string $name): self
    {
        $season = new static();

        $season->name = $name;
        $season->status = self::STATUS_ACTIVE;
        $season->save();

        return $season;
    }

    /**
     * @return $this
     * @throws \DomainException|\Throwable
     */
    public function complete(): self
    {
        throw_if($this->isComplete(), new \DomainException(__('Season is already completed.')));

        $this->update(['status' => self::STATUS_COMPLETE]);

        return static::create('Season #' . ($this->id + 1));
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isComplete(): bool
    {
        return $this->status == self::STATUS_COMPLETE;
    }
}
