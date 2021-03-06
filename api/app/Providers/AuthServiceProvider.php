<?php

namespace App\Providers;
use Laravel\Passport\Passport;

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

        Passport::routes();

        Passport::tokensExpireIn(
            now()->addMinutes(config('auth.oauth_tokens_expire_in'))
        );
        Passport::refreshTokensExpireIn(
            now()->addMinutes(config('auth.oauth_refresh_tokens_expire_in'))
        );
        Passport::personalAccessTokensExpireIn(
            now()->addMinutes(config('auth.oauth_personal_access_tokens_expire_in'))
        );
    }
}
