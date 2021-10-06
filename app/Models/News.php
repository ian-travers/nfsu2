<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\News
 *
 * @property int $id
 * @property string $title_en
 * @property string $title_ru
 * @property string|null $slug
 * @property string $body_en
 * @property string $body_ru
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $body
 * @property-read mixed $title
 * @method static \Database\Factories\NewsFactory factory(...$parameters)
 * @method static Builder|News newModelQuery()
 * @method static Builder|News newQuery()
 * @method static Builder|News query()
 * @method static Builder|News whereBodyEn($value)
 * @method static Builder|News whereBodyRu($value)
 * @method static Builder|News whereCreatedAt($value)
 * @method static Builder|News whereId($value)
 * @method static Builder|News whereSlug($value)
 * @method static Builder|News whereStatus($value)
 * @method static Builder|News whereTitleEn($value)
 * @method static Builder|News whereTitleRu($value)
 * @method static Builder|News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    use HasFactory, NativeAttribute, HasComments;

    protected static function boot()
    {
        parent::boot();

        static::created(fn($news) => $news->update(['slug' => Str::slug($news->title_en) . '-' . Str::padLeft($news->id, 8, '0')]));
    }

    public function getTitleAttribute()
    {
        return $this->getNativeAttributeValue('title');
    }

    public function getBodyAttribute()
    {
        return $this->getNativeAttributeValue('body');
    }
}
