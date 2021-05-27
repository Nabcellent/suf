<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use SmoDav\Mpesa\C2B\STK;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            STK::class,     // Original class
            \App\Misc\Overrides\Mpesa\C2B\STK::class    // Custom class
        );

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
    public function boot(): void {
        //  Use Bootstrap for paginator
        Paginator::useBootstrap();

        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
