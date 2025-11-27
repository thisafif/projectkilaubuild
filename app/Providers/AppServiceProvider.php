<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // Paksa HTTPS cuma di production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Bypass semua Gate / Shield buat super_admin
        Gate::before(function ($user, string $ability) {
            if ($user && method_exists($user, 'hasRole')) {
                if ($user->hasRole(config('filament-shield.super_admin.name'))) {
                    return true;
                }
            }

            return null; // user lain jalan normal
        });
    }
}
