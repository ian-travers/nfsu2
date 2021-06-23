<?php

namespace App\Providers;

use App\Models\Tourney\Tourney;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', fn(User $user) => $user->isAdmin());
        Gate::define('racer', fn(User $user) => $user->isRacer());

        Gate::define('update-tourney', fn(User $user, Tourney $tourney) => $user->id == $tourney->supervisor_id);
    }
}
