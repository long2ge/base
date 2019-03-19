<?php

namespace App\Providers;

use Carbon\Carbon;
use Dusterio\LumenPassport\LumenPassport;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

//        $this->app['auth']->viaRequest('api', function ($request) {
//            if ($request->input('api_token')) {
//                return User::where('api_token', $request->input('api_token'))->first();
//            }
//        });

        LumenPassport::routes($this->app->router);

        // access_token 过期时间
        LumenPassport::tokensExpireIn(Carbon::now()->addDays(15));

        // refreshTokens 过期时间
        Passport::tokensExpireIn(Carbon::now()->addDays(7));

        // 刷新令牌过期时间 - 30天
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
