<?php

namespace App\Models;

use App\Events\BecomeRacer;
use App\Models\Conversation\Dialogue;
use App\Models\Conversation\Message;
use App\Models\Tourney\SeasonAward;
use App\Models\Tourney\SeasonRacer;
use App\Models\Tourney\Tourney;
use App\Models\Tourney\TourneyRacer;
use App\ReadRepositories\SeasonHelper;
use App\Settings\SeasonSettings;
use App\Settings\SitePointsSettings;
use DomainException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Spatie\Activitylog\Traits\CausesActivity;

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
 * @property int $site_points
 * @property int $tourneys_finished_count
 * @property int $first_places
 * @property int $second_places
 * @property int $third_places
 * @property int $competitions_count
 * @property bool $is_browser_notified
 * @property bool $is_email_notified
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $locale
 * @property-read mixed $competition_podiums
 * @property-read mixed $tourney_podiums
 * @property-read \Illuminate\Database\Eloquent\Collection|Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|SeasonRacer[] $racedSeasons
 * @property-read int|null $raced_seasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|SeasonAward[] $seasonAwards
 * @property-read int|null $season_awards_count
 * @property-read \App\Models\Team|null $team
 * @property-read \Illuminate\Database\Eloquent\Collection|Tourney[] $tourneys
 * @property-read int|null $tourneys_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trophy[] $trophies
 * @property-read int|null $trophies_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User racer()
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereCompetitionsCount($value)
 * @method static Builder|User whereCountry($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstPlaces($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereIsBrowserNotified($value)
 * @method static Builder|User whereIsEmailNotified($value)
 * @method static Builder|User whereLocale($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereSecondPlaces($value)
 * @method static Builder|User whereSitePoints($value)
 * @method static Builder|User whereTeamId($value)
 * @method static Builder|User whereThirdPlaces($value)
 * @method static Builder|User whereTourneysFinishedCount($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, CausesActivity;

    public const ROLE_USER = 'user';
    public const ROLE_RACER = 'racer';
    public const ROLE_SUPERVISOR = 'supervisor';

    protected $hidden = ['password', 'remember_token', 'email'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_browser_notified' => 'boolean',
        'is_email_notified' => 'boolean',
    ];

    protected $with = ['team'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function trophies()
    {
        return $this->hasMany(Trophy::class)->orderByDesc('id');
    }

    public function tourneyTrophies()
    {
        return $this->trophies()->where('trophiable_type', 'tourney');
    }

    public function seasonAwards()
    {
        return $this->hasMany(SeasonAward::class)->orderByDesc('id');
    }

    public function seasonOverallAwards(int $seasonIndex = null)
    {
        return $this->seasonAwardsByType('overall', SeasonHelper::index($seasonIndex));
    }

    public function seasonCircuitAwards(int $seasonIndex = null)
    {
        return $this->seasonAwardsByType('circuit', SeasonHelper::index($seasonIndex));
    }

    public function seasonSprintAwards(int $seasonIndex = null)
    {
        return $this->seasonAwardsByType('sprint', SeasonHelper::index($seasonIndex));
    }

    public function seasonDragAwards(int $seasonIndex = null)
    {
        return $this->seasonAwardsByType('drag', SeasonHelper::index($seasonIndex));
    }

    public function seasonDriftAwards(int $seasonIndex = null)
    {
        return $this->seasonAwardsByType('drift', SeasonHelper::index($seasonIndex));
    }

    public function seasonCompetitionAwards(int $seasonIndex = null)
    {
        return $this->seasonAwardsByType('competition', SeasonHelper::index($seasonIndex));
    }

    protected function seasonAwardsByType(string $type, int $seasonIndex)
    {
        return $this->seasonAwards()
            ->where(['type'=> $type, 'season_index' => $seasonIndex])
            ->get();
    }

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

        activity()
            ->causedBy($this)
            ->log(__("You created the team: ':name'.", ['name' => "{$team->name} - {$team->clan}"]));

        $this->gainSitePoints(app(SitePointsSettings::class)->create_team);
    }

    public function joinTeam(Team $team): void
    {
        $this->update(['team_id' => $team->id]);

        activity()
            ->causedBy($this)
            ->log(__("You joined the team: ':name'.", ['name' => "{$team->name} - {$team->clan}"]));

        $this->gainSitePoints(app(SitePointsSettings::class)->join_team);
    }

    public function leaveTeam(): void
    {
        $this->update(['team_id' => null]);

        activity()
            ->causedBy($this)
            ->log(__("You left the team."));

        $this->loseSitePoints(app(SitePointsSettings::class)->join_team);
    }

    public function isTeamMember(): bool
    {
        return isset($this->team_id);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function isTeamCaptain(): bool
    {
        if (!$this->isTeamMember()) {
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
        throw_unless(array_key_exists($role, self::rolesList()), new InvalidArgumentException(__('Unknown role :role.', ['role' => $role])));

        throw_if($this->role === $role, new DomainException(__('This role has already been assigned.')));

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

    public function revokeAdminRights(): void
    {
        $this->update(['is_admin' => false]);
    }

    public function changePassword(string $password): void
    {
        $this->update(['password' => bcrypt($password)]);
    }

    public static function setRacer(self $user)
    {
        throw_if($user->isRacer(), new DomainException(__('You are already a racer.')));

        $user->update(['role' => self::ROLE_RACER]);

        event(new BecomeRacer($user));
    }

    public function tourneys()
    {
        return $this->hasMany(Tourney::class, 'supervisor_id');
    }

    public function isSignedForTourney(Tourney $tourney)
    {
        return $tourney->racers()->where('user_id', $this->id)->exists();
    }

    public function isSigned(): bool
    {
        $activeTourneys = Tourney::activeTourneys();

        return ($activeTourneys->filter(function ($tourney) {
            return $this->isSignedForTourney($tourney);
        }))->count();
    }

    public function hasUnhandledTourney(): bool
    {
        return Tourney::unhandledTourneysFor($this)->count();
    }

    public function signupTourney(Tourney $tourney)
    {
        throw_unless($this->isRacer(), new DomainException(__('You have no right to sign up the tourney. You must pass the racer test first.')));

        TourneyRacer::create([
            'tourney_id' => $tourney->id,
            'user_id' => $this->id,
            'racer_username' => $this->username,
        ]);
    }

    public function withdrawTourney(Tourney $tourney)
    {
        throw_unless($this->isRacer(), new DomainException(__('You have no right to withdraw yourself from the tourney. You must pass the racer test first.')));

        $tourney->racers()->where('user_id', $this->id)->delete();
    }

    public function gainSitePoints(int $value): void
    {
        $this->increment('site_points', $value);
    }

    public function loseSitePoints(int $value): void
    {
        $this->site_points - $value < 0
            ? $this->update(['site_points' => 0])
            : $this->decrement('site_points', $value);
    }

    public function incrementTourneysFinishedCount(): void
    {
        $this->increment('tourneys_finished_count');
    }

    public function incrementPodiumsCount(string $places): void
    {
        $this->increment($places);
    }

    public function getTourneyPodiumsAttribute()
    {
        return $this->first_places + $this->second_places + $this->third_places;
    }

    public function getCompetitionPodiumsAttribute()
    {
        return $this->trophies()->where('trophiable_type', 'competition')->count();
    }

    public function racedSeasons()
    {
        return $this->hasMany(SeasonRacer::class);
    }

    public function currentSeasonDetails()
    {
        return $this->racedSeasons()->where('season_index', app(SeasonSettings::class)->index)->first();
    }

    public static function existsByUsername(string $username): bool
    {
        return self::where('username', $username)->without('team')->exists();
    }

    public function browserNotified(): bool
    {
        return $this->is_browser_notified;
    }

    public function unsetBrowserNotified(): self
    {
        $this->update(['is_browser_notified' => false]);

        return $this;
    }

    public function setBrowserNotified(): self
    {
        $this->update(['is_browser_notified' => true]);

        return $this;
    }

    public function emailNotified(): bool
    {
        return $this->is_email_notified;
    }

    public function unsetEmailNotified(): self
    {
        $this->update(['is_email_notified' => false]);

        return $this;
    }

    public function setEmailNotified(): self
    {
        $this->update(['is_email_notified' => true]);

        return $this;
    }

    /**
     * @return \App\Models\User[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function allBrowserNotified()
    {
        return self::where('is_browser_notified', true)->get();
    }

    /**
     * @return \App\Models\User[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function allEmailNotified()
    {
        return self::where('is_email_notified', true)->get();
    }

    public function scopeRacer($query)
    {
        return $query->where('role', self::ROLE_RACER);
    }

    public function dialoguesCount(): int
    {
        return Dialogue::allByUser()->count();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function hasUnreadMessages(): bool
    {
        return Message::where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->exists();
    }
}
