<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Helpers\Aid;
use App\Helpers\ChartAid;
use App\Models\Product;
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
        $frequency = 'weekly';

        $products = Product::select(['created_at'])->whereBetween('created_at', [chartStartDate($frequency), now()])
            ->get()->groupBy(function($item) use ($frequency) {
                return chartDateFormat($item->created_at, $frequency);
            });

        $products = ChartAid::chartDataSet($products, $frequency);

        return Chartisan::build()
            ->labels($products['labels'])
            ->dataset('Products', $products['datasets']);
    }
}
