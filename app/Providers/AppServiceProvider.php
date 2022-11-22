<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('isAdmin', function ($user) {
            return $user->role_id == 1;
        });

        Gate::define('isSuperAdmin', function ($user) {
            return $user->role_id == 4;
        });

        Gate::define('isSubAdmin', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('isUser', function ($user) {
            return $user->role_id == 3;
        });

        Cashier::calculateTaxes();
    }
}
