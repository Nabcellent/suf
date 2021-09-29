<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\OrdersProduct;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersProductChart extends BaseChart {
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'orders.product';

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
        $topProducts = OrdersProduct::join('products', 'orders_products.product_id', '=', 'products.id')
            ->select(['product_id', 'title', DB::raw("SUM(quantity) as total")])
            ->groupBy('product_id')->latest('total')->take(5)->get();

        return Chartisan::build()
            ->labels($topProducts->pluck('title')->toArray())
            ->dataset('Sample', $topProducts->pluck('total')->toArray());
    }
}
