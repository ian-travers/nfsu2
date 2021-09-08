<?php

namespace App\Models\Tourney;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Tourney\SeasonAward
 *
 * @property int $id
 * @property int $user_id
 * @property int $season_index
 * @property string $type
 * @property string $place
 * @property-read User $user
 * @method static Builder|SeasonAward newModelQuery()
 * @method static Builder|SeasonAward newQuery()
 * @method static Builder|SeasonAward query()
 * @method static Builder|SeasonAward whereId($value)
 * @method static Builder|SeasonAward wherePlace($value)
 * @method static Builder|SeasonAward whereSeasonIndex($value)
 * @method static Builder|SeasonAward whereType($value)
 * @method static Builder|SeasonAward whereUserId($value)
 * @mixin \Eloquent
 */
class SeasonAward extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function htmlTitleAttribute(): string
    {
        return __('Season') . ' #' . $this->season_index . ' - ' . Str::ucfirst($this->type);
    }
}
