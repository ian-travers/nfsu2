<?php

namespace App\Models;

use DomainException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $captain_id
 * @property string $clan
 * @property string $name
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $captain
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $racers
 * @property-read int|null $racers_count
 * @method static \Database\Factories\TeamFactory factory(...$parameters)
 * @method static Builder|Team newModelQuery()
 * @method static Builder|Team newQuery()
 * @method static Builder|Team query()
 * @method static Builder|Team whereCaptainId($value)
 * @method static Builder|Team whereClan($value)
 * @method static Builder|Team whereCreatedAt($value)
 * @method static Builder|Team whereId($value)
 * @method static Builder|Team whereName($value)
 * @method static Builder|Team wherePassword($value)
 * @method static Builder|Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    use HasFactory;

    protected $hidden = ['password'];

    protected $guarded = [];

    public function captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }

    public function racers()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @throws \Throwable
     */
    public function removeMember(User $user)
    {
        throw_if($user->isTeamCaptain(), new DomainException(__('Impossible to remove team captain.')));
        throw_unless($user->team_id == $this->id, new DomainException(__('It is impossible to delete a member of another team.')));

        $user->update(['team_id' => null]);
    }

    /**
     * @param \App\Models\User $user
     * @throws \Throwable
     */
    public function transferCaptainship(User $user)
    {
        throw_if($user->isTeamCaptain(), new DomainException(__('Impossible to transfer to yourself.')));
        throw_unless($user->team_id == $this->id, new DomainException(__('It is impossible to transfer captainship to a member of another team.')));

        $this->update(['captain_id' => $user->id]);
    }

    /**
     * @throws \Throwable
     */
    public function dismiss()
    {
        throw_unless(auth()->id() == $this->captain_id, new DomainException(__('Only the captain can dismiss the team.')));

        $this->racers->map(function ($racer) {
            $racer->update(['team_id' => null]);
        });

        $this->delete();
    }
}
