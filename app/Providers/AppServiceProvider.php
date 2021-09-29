<?php

namespace App\Providers;

use App\Charts\BestSellersChart;
use App\Charts\EsteemedCustomersChart;
use App\Charts\OrderChart;
use App\Charts\OrdersProductChart;
use App\Charts\ProductChart;
use App\Charts\UserChart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

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
     * @param Charts $charts
     * @return void
     */
    public function boot(Charts $charts): void {
        //  Use Bootstrap for paginator
        Paginator::useBootstrap();

        if(config('app.env') === 'production') URL::forceScheme('https');

        $charts->register([
            UserChart::class,
            ProductChart::class,
            OrderChart::class,
            OrdersProductChart::class,
            EsteemedCustomersChart::class,
            BestSellersChart::class,
        ]);
    }
}
