<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Helpers\Aid;
use App\Models\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class UserChart extends BaseChart {

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'users';

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
        $users = User::whereBetween('created_at', [now()->subWeek(), now()]);

        $customers = $users->where('is_admin', 0)->get(['created_at'])->groupBy(function($item) {
            return $item->created_at->toDateString();
        });

        $sellers = $users->whereHas('admin', function($query) {
            $query->where('type', 'Seller');
        })->get(['created_at'])->groupBy(function($item) {
            return $item->created_at->toDateString();
        });

        $customers = Aid::chartDataSet($customers);
        $sellers = Aid::chartDataSet($sellers);

        return Chartisan::build()
            ->labels($customers['labels'])
            ->dataset('Sellers', $sellers['datasets'])
            ->dataset('Customers', $customers['datasets']);
    }
}
