<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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

    //  ini adalah function inti untuk proses autentikasi user
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            // kita tampung token yang dimasukan user pada headers
            $token = $request->header('token');

            // cek apakah token ada di database ?
            $user = User::where('token', $token)->first();
            
            // jika ada maka return user
            if ($user) {
                return new User();
            }

            
        });
    }
}
