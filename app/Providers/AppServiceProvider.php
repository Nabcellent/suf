<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //  Use Bootstrap for paginators
        Paginator::useBootstrap();


        //  Header Content
        $user = Auth::user();

        //  Navbar Content
        $sections = Category::sections();
        $categories = Category::sections();
        $latestFour = Product::products()->where('products.status', 1)
            ->orderByDesc('products.created_at')->limit(4)->get()->toArray();

        //  Footer Content
        $footerInfo = [
            'trendingCategories' => Product::all()
        ];

        View::share(compact('user','sections', 'categories', 'latestFour', 'footerInfo'));
    }
}
