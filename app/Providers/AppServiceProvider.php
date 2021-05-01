<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        // the original class
            STK::class,
            // my custom class
            \App\Overrides\Mpesa\C2B\STK::class
        );
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
