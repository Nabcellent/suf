<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class EsteemedCustomersChart extends BaseChart {
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'esteemed.customers';

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
        $topCustomers = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->select(['user_id', 'first_name', DB::raw("SUM(total) as total")])
            ->groupBy('user_id')->latest('total')->take(5)->get();

        $totals = $topCustomers->pluck('total')->map(function($item) {
            return $item;
            return (new NumberFormatter('en_GB', NumberFormatter::CURRENCY))->formatCurrency($item, 'KES');
        })->toArray();

        return Chartisan::build()
            ->labels($topCustomers->pluck('first_name')->toArray())
            ->dataset('Customers', $totals);
    }
}
