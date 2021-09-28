<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Helpers\Aid;
use App\Models\Order;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class OrderChart extends BaseChart {
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'orders';

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
        $orders = Order::whereBetween('created_at', [now()->subWeek(), now()])
            ->get(['created_at'])->groupBy(function($item) {
                return $item->created_at->toDateString();
            });

        $orders = Aid::chartDataSet($orders);

        return Chartisan::build()
            ->labels($orders['labels'])
            ->dataset('Orders', $orders['datasets']);
    }
}
