<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Like
 *
 * @property int $id
 * @property string $likeable_type
 * @property int $likeable_id
 * @property int $user_id
 * @property string $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $likeable
 * @method static \Database\Factories\LikeFactory factory(...$parameters)
 * @method static Builder|Like newModelQuery()
 * @method static Builder|Like newQuery()
 * @method static Builder|Like query()
 * @method static Builder|Like whereCreatedAt($value)
 * @method static Builder|Like whereId($value)
 * @method static Builder|Like whereLikeableId($value)
 * @method static Builder|Like whereLikeableType($value)
 * @method static Builder|Like whereTypeId($value)
 * @method static Builder|Like whereUpdatedAt($value)
 * @method static Builder|Like whereUserId($value)
 * @mixin \Eloquent
 */
class Like extends Model
{
    use HasFactory;

    const LIKE = 'like';
    const DISLIKE = 'dislike';

    protected $guarded = [];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function toggle()
    {
        $this->update(['type_id' => $this->type_id == self::LIKE ? self::DISLIKE : self::LIKE]);
    }
}
