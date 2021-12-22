<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Stevebauman\Purify\Facades\Purify;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $parent_id
 * @property string $body
 * @property string $commentable_type
 * @property int $commentable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read Model|\Eloquent $commentable
 * @property-read mixed $is_disliked
 * @property-read mixed $is_liked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likesAndDislikes
 * @property-read int|null $likes_and_dislikes_count
 * @method static \Database\Factories\CommentFactory factory(...$parameters)
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereBody($value)
 * @method static Builder|Comment whereCommentableId($value)
 * @method static Builder|Comment whereCommentableType($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereParentId($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use HasFactory, HasLikesDislikes, LogsActivity;

    protected static array $recordEvents = ['created', 'deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public static function createComment($commentable, $body, $author, $parent_id = null): self
    {
        return $commentable->comments()->create([
            'body' => Purify::clean($body),
            'user_id' => $author->id,
            'parent_id' => $parent_id ? (int)$parent_id : null,
        ]);
    }

    public static function updateComment($id, $data)
    {
        return (bool)static::find($id)->update($data);
    }

    public static function deleteComment($id): bool
    {
        return (bool)static::find($id)->delete();
    }

    public static function treeRecursive(&$comments, $parentId): array
    {
        $items = [];

        /** @var self $comment */
        foreach ($comments as $comment) {
            if ($comment->parent_id == $parentId) {
                $items[] = new CommentView($comment, self::treeRecursive($comments, $comment->id));
            }
        }

        return $items;
    }

    public function hasChild(): bool
    {
        /** @var self $comment */
        foreach (self::all() as $comment) {
            if ($comment->parent_id == $this->id) {
                return true;
            }
        }

        return false;
    }
}
