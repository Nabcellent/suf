<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
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
        //  Header Content
        $user = Auth::user();

        //  Navbar Content
        $sections = Category::sections();
        $categories = Category::sections();

        //  Footer Content
        $footerInfo = [
            'trendingCategories' => Product::all()
        ];

        View::share(compact('user','sections', 'categories', 'footerInfo'));
    }
}
