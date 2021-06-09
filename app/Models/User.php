<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $username
 * @property string $country
 * @property string|null $avatar
 * @property int|null $team_id
 * @property string $email
 * @property string $role
 * @property bool $is_admin
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $locale
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereCountry($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereLocale($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereTeamId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public const ROLE_USER = 'user';
    public const ROLE_RACER = 'racer';
    public const ROLE_SUPERVISOR = 'supervisor';

    protected $fillable = ['username', 'country', 'avatar', 'email', 'password', 'team_id', 'role', 'is_admin'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function hasAvatar(): bool
    {
        return (bool)$this->avatar;
    }

    public function removeAvatarFile(): bool
    {
        if (!$this->hasAvatar()) {
            return false;
        }

        Storage::disk('public')->delete($this->avatar);

        return $this->update(['avatar' => null]);
    }

    public function createTeam(array $data): void
    {
        $data['captain_id'] = $this->id;

        $team = Team::create($data);

        $this->joinTeam($team);
    }

    public function joinTeam(Team $team): void
    {
        $this->update(['team_id' => $team->id]);
    }

    public function leaveTeam(): void
    {
        $this->update(['team_id' => null]);
    }

    public function isTeamMember(): bool
    {
        return isset($this->team_id);
    }

    public function isTeamCaptain(): bool
    {
        if(!$this->isTeamMember()) {
            return false;
        }

        $team = Team::findOrFail($this->team_id);

        return $this->id === $team->captain->id;
    }

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => __('user'),
            self::ROLE_RACER => __('racer'),
            self::ROLE_SUPERVISOR => __('supervisor'),
        ];
    }

    public function getRole(): string
    {
        return self::rolesList()[$this->role];
    }

    /**
     * @param $role
     * @throws \Throwable
     */
    public function changeRole($role): void
    {
        throw_unless(array_key_exists($role, self::rolesList()), new \InvalidArgumentException(__('Unknown role :role.', ['role' => $role])));

        throw_if($this->role === $role, new \DomainException(__('This role has already been assigned.')));

        $this->update(['role' => $role]);
    }

    public function isUser(): bool
    {
        return $this->role == self::ROLE_USER;
    }

    public function isRacer(): bool
    {
        return $this->role == self::ROLE_RACER;
    }

    public function isSupervisor(): bool
    {
        return $this->role == self::ROLE_SUPERVISOR;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function setAdminRights(): void
    {
        $this->update(['is_admin' => true]);
    }
}
