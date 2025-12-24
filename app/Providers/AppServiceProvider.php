<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production (required for Render deployment)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

//        pagination on index pages
        Paginator::useBootstrap();

//        reset password link
//        ResetPassword::createUrlUsing(function (User $user, string $token) {
//            return 'https://example.com/reset-password?token='.$token;
//        });
    }
}
