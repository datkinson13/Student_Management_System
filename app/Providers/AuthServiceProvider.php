<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerUserActionPolicies();
        //
    }

    public function registerUserActionPolicies()
    {
        // Define a gate allowing a users permissions to be changed.
        Gate::define('change-permissions', function ($user) {
            return $user->hasAccess(['change-permissions']);
        });

        // Define a gate allowing user deletion.
        Gate::define('user-delete', function ($user) {
            return $user->hasAccess(['user-delete']);
        });
    }
}
