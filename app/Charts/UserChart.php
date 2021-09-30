<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Helpers\Aid;
use App\Helpers\ChartAid;
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
        $frequency = 'daily';

        $users = User::select(['created_at'])->whereBetween('created_at', [chartStartDate($frequency), now()]);
        $customers = $users->get()->where('is_admin', 0)->groupBy(function($item) use ($frequency) {
            return chartDateFormat($item->created_at, $frequency);
        });
        $sellers = $users->whereHas('admin', function($query) {
            $query->where('type', 'Seller');
        })->get()->groupBy(function($item) use ($frequency) {
            return chartDateFormat($item->created_at, $frequency);
        });

        $customers = ChartAid::chartDataSet($customers, $frequency);
        $sellers = ChartAid::chartDataSet($sellers, $frequency);

        return Chartisan::build()
            ->labels($customers['labels'])
            ->dataset('Sellers', $sellers['datasets'])
            ->dataset('Customers', $customers['datasets']);
    }
}
