<?php

namespace App\Models\Conversation;

use App\Models\User;
use DomainException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Conversation\Dialogue
 *
 * @property int $id
 * @property int $initiator_id
 * @property int $companion_id
 * @property bool $blocked
 * @property-read User $companion
 * @property-read string $partner_username
 * @property-read User $initiator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Conversation\Message[] $messages
 * @property-read int|null $messages_count
 * @method static \Database\Factories\Conversation\DialogueFactory factory(...$parameters)
 * @method static Builder|Dialogue newModelQuery()
 * @method static Builder|Dialogue newQuery()
 * @method static Builder|Dialogue query()
 * @method static Builder|Dialogue whereBlocked($value)
 * @method static Builder|Dialogue whereCompanionId($value)
 * @method static Builder|Dialogue whereId($value)
 * @method static Builder|Dialogue whereInitiatorId($value)
 * @mixin \Eloquent
 */
class Dialogue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'blocked' => 'boolean',
    ];

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id')->without('team');
    }

    public function companion()
    {
        return $this->belongsTo(User::class, 'companion_id')->without('team');
    }

    public function partner()
    {
        return $this->initiator->is(auth()->user())
            ? $this->companion
            : $this->initiator;
    }

    public function getPartnerUsernameAttribute(): string
    {
        return $this->partner()->username;
    }

    public function frontendPath(): string
    {
        return url("cabinet/dialogues/{$this->partnerUsername}");
    }

    public function you()
    {
        return $this->initiator->is(auth()->user())
            ? $this->initiator
            : $this->companion;
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }

    public function addMessage(string $body, User $user = null): self
    {
        $this->messages()->create([
            'user_id' => $user ? $user->id : auth()->id(),
            'body' => $body,
        ]);

        return $this;
    }

    public static function findWith(string $username, bool $createNew = false): ?self
    {
        throw_if(is_null($companion = User::whereUsername($username)->first()), new DomainException(__("Invalid username for conversation.")));

        $initiatorId = auth()->id();
        $companionId = $companion->id;

        $dialog = self::where(['initiator_id' => $initiatorId, 'companion_id' => $companionId])
            ->orWhere(fn($query) => $query
                ->where(['initiator_id' => $companionId, 'companion_id' => $initiatorId])
            )->first();

        if ($dialog) {
            return $dialog;
        }

        return $createNew
            ? self::create(['initiator_id' => $initiatorId, 'companion_id' => $companionId])
            : null;
    }

    public static function allByUser(User $user = null): Builder
    {
        throw_if(auth()->guest(), new DomainException(__('You must be logged in')));

        $user = $user ?? auth()->user();

        return self::where('initiator_id', $user->id)
            ->orWhere('companion_id', $user->id);
    }
}
