<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\OrdersProduct;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BestSellersChart extends BaseChart {
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'best.sellers';

    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth', 'super'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan {
        $bestSellers = OrdersProduct::select(['seller_id', 'username', DB::raw("COUNT(*) as count")])
            ->join('products', 'orders_products.product_id', '=', 'products.id')
            ->join('admins', 'products.seller_id', '=', 'admins.user_id')
            ->groupBy(['seller_id', 'username'])->latest('count')->take(5)->get();

        return Chartisan::build()
            ->labels($bestSellers->pluck('username')->toArray())
            ->dataset('Sample', $bestSellers->pluck('count')->toArray());
    }
}
