<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

       /* if (! $this->app->routesAreCached()) {
            Passport::routes();
            Passport::tokensExpireIn(now()->addDays(1));
            }
            */
         Passport::tokensExpireIn(Carbon::now()->addMinutes(5));
        //Passport::refreshTokensExpireIn(now()->addDays(30));
       // Passport::personalAccessTokensExpireIn(Carbon::now()->addMinutes(5));
    }
}
