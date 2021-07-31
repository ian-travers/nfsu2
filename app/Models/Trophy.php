<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Trophy
 *
 * @property int $id
 * @property int $user_id
 * @property string $trophiable_type
 * @property int $trophiable_id
 * @property string $place
 * @property-read Model|\Eloquent $trophiable
 * @property-read \App\Models\User $user
 * @method static Builder|Trophy newModelQuery()
 * @method static Builder|Trophy newQuery()
 * @method static Builder|Trophy query()
 * @method static Builder|Trophy whereId($value)
 * @method static Builder|Trophy wherePlace($value)
 * @method static Builder|Trophy whereTrophiableId($value)
 * @method static Builder|Trophy whereTrophiableType($value)
 * @method static Builder|Trophy whereUserId($value)
 * @mixin \Eloquent
 */
class Trophy extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trophiable()
    {
        return $this->morphTo();
    }
}
