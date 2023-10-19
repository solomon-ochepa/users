<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreMigrations();
        Passport::ignoreRoutes();

        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
         * Once enabled, all of your client secrets will only be displayable to the user immediately after they are created.
         * Since the plain-text client secret value is never stored in the database, it is not possible to recover the secret's value if it is lost.
         */
        // Passport::hashClientSecrets();

        Passport::tokensExpireIn(now()->addDays(30));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(3));

        //
    }
}
