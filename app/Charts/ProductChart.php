<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Helpers\Aid;
use App\Models\Product;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ProductChart extends BaseChart {
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'products';

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
        $products = Product::whereBetween('created_at', [now()->subWeek(), now()])
            ->get(['created_at'])->groupBy(function($item) {
                return $item->created_at->toDateString();
            });

        $products = Aid::chartDataSet($products);

        return Chartisan::build()
            ->labels($products['labels'])
            ->dataset('Orders', $products['datasets']);
    }
}
