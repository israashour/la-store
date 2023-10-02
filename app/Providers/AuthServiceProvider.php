<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    public function register()
    {
        parent::register();
        $this->app->bind('permissions', function() {
            return include base_path('data/permissions.php');
        });
    }

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // $permissions = include base_path('data/permissions.php');

        Gate::before(function ($user, $permissions) {
            if($user->super_admin){
                return true;
            }
        });

        foreach ($this->app->make('permissions') as $code => $label) {
            Gate::define($code, function ($user) use ($code) {
                return $user->hasPermission($code);
            });
        }
    }
}
