<?php

namespace App\Models;

use App\Events\PostPublished;
use App\Events\PostUnpublished;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string|null $slug
 * @property string $excerpt
 * @property string $body
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $is_disliked
 * @property-read mixed $is_liked
 * @property-read bool $published
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likesAndDislikes
 * @property-read int|null $likes_and_dislikes_count
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|Post onlyTrashed()
 * @method static Builder|Post published()
 * @method static Builder|Post query()
 * @method static Builder|Post whereAuthorId($value)
 * @method static Builder|Post whereBody($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDeletedAt($value)
 * @method static Builder|Post whereExcerpt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereImage($value)
 * @method static Builder|Post wherePublishedAt($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory, SoftDeletes, HasComments, HasLikesDislikes, HasUniqueSlug;

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function path(): string
    {
        return "/blog/{$this->slug}";
    }

    public function publish(Carbon $when = null): void
    {
        $this->update(['published_at' => $when ?? now()]);

        event(new PostPublished($this->author, $this));
    }

    public function unpublish(): void
    {
        $this->update(['published_at' => null]);

        event(new PostUnpublished($this->author));
    }

    public function getPublishedAttribute(): bool
    {
        return (bool)$this->published_at;
    }

    public function hasImage(): bool
    {
        return (bool)$this->image;
    }

    public function imageFileExists():bool
    {
        if (!$this->hasImage()) {
            return false;
        }

        return Storage::disk('public')->exists($this->image);
    }

    public function imageUrl(): string
    {
        return $this->imageFileExists()
            ? Storage::url($this->image)
            : '';
    }

    public function removeImage(): void
    {
        if ($this->imageFileExists()) {
            Storage::disk('public')->delete($this->image);
        }

        $this->update(['image' => null]);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }
}
