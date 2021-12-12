<?php

namespace App\Models\Conversation;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Conversation\Message
 *
 * @property int $id
 * @property int $dialogue_id
 * @property int $user_id
 * @property string $body
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversation\Dialogue $dialogue
 * @property-read User $user
 * @method static Builder|Message newModelQuery()
 * @method static Builder|Message newQuery()
 * @method static Builder|Message query()
 * @method static Builder|Message whereBody($value)
 * @method static Builder|Message whereCreatedAt($value)
 * @method static Builder|Message whereDialogueId($value)
 * @method static Builder|Message whereId($value)
 * @method static Builder|Message whereReadAt($value)
 * @method static Builder|Message whereUpdatedAt($value)
 * @method static Builder|Message whereUserId($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class)->without('team');
    }

    public function dialogue()
    {
        return $this->belongsTo(Dialogue::class);
    }
}
