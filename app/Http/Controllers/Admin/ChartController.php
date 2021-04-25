<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChartController extends Controller
{
    public string $model;

    /**
     * @throws \Exception
     */
    function getAllDates(): array {
        $daysArr = [];
        $monthsArr = [];

        $Dates = $this->model::orderBy('created_at')->pluck('created_at')->toArray();

        if(!empty($Dates)) {
            foreach($Dates as $date) {
                $day = Carbon::parse($date)->format('D');
                $dayNo = Carbon::parse($date)->format('d');
                $month = Carbon::parse($date)->format('M');
                $monthNo = Carbon::parse($date)->format('m');

                $daysArr[$dayNo] = $day;
                $monthsArr[$monthNo] = $month;
            }
        }

        return array('days' => $daysArr, 'months' => $monthsArr);
    }


    function getCount($day = null, $month = null): array {
        //  Where Day/Month/Year/Time/Date --- --- --- --- --- --- --- --- --- --- LARAVEL WHERE FUNCTIONS
        $day = (!$day) ? Carbon::now()->format('d') : $day;
        $month = (!$month) ? Carbon::now()->format('m') : $month;

        if($this->model === "Customer") {
            $dailyCount = User::where('is_admin', 0)->whereDay('created_at', $day)->count();
            $monthlyCount = User::where('is_admin', 0)->whereMonth('created_at', $month)->count();
        } else if($this->model === "Seller") {
            $dailyCount = Admin::where('type', "Seller")->whereDay('created_at', $day)->count();
            $monthlyCount = Admin::where('type', "Seller")->whereMonth('created_at', $month)->count();
        } else {
            $dailyCount = $this->model::whereDay('created_at', $day)->count();
            $monthlyCount = $this->model::whereMonth('created_at', $month)->count();
        }

        return [
            'dailyCount' => $dailyCount,
            'monthlyCount' => $monthlyCount
        ];
    }


    function getTimelyData(Request $request): JsonResponse {
        $response = [
            'days' => $this->getLastSevenDays(),
            'months' => $this->getLastThreeMonths(),
            'tables' => [],
        ];

        $models = $request->MODELS;

        if(!$models) {
            $models = ["Order"];
        }

        $maxD = 5;
        $maxM = 10;
        foreach($models as $model) {
            if($model === "Customer" || $model === "Seller") {
                $this->model = $model;
            } else {
                $this->model = $this->getModel($model);
            }

            $dailyCountArr = [];
            $monthlyCountArr = [];

            foreach($this->getLastSevenDays()['byNum'] as $day) {
                $dailyCount = $this->getCount($day)['dailyCount'];
                $dailyCountArr[] = $dailyCount;
            }

            foreach($this->getLastThreeMonths()['byNum'] as $month) {
                $monthlyCount = $this->getCount(null, $month)['monthlyCount'];
                $monthlyCountArr[] = $monthlyCount;
            }

            $maxDay = round((max($dailyCountArr) + 5) / 10) * 10;
            $maxMonth = round((max($monthlyCountArr) + 5) / 10) * 10;

            if($maxDay > $maxD) {
                $response['maxDay'] = $maxDay;
            }
            if($maxMonth > $maxM) {
                $response['maxMonth'] = $maxMonth;
            }

            $response['tables'][] = [
                'modelName' => Str::plural($model),
                'dailyCountData' => $dailyCountArr,
                'monthlyCountData' => $monthlyCountArr,
            ];
        }

        return response()->json(['data' => $response, 200]);
    }

    public function getLastSevenDays(): array {
        $period = CarbonPeriod::create(now()->subDays(7), now());
        $dates = [
            'byNum' => [],
            'byName' => [],
        ];

        foreach ($period as $date) {
            $dates['byNum'][] = $date->format('d');
            $dates['byName'][] = $date->format('D');
        }

        return $dates;
    }

    public function getLastThreeMonths(): array {
        $period = CarbonPeriod::create(now()->subMonths(2), '1 month', now());
        $dates = [
            'byNum' => [],
            'byName' => [],
        ];

        foreach ($period as $date) {
            $dates['byNum'][] = $date->format('m');
            $dates['byName'][] = $date->format('M');
        }

        return $dates;
    }

    function getModel($model): string {
        $model = Str::singular(Str::ucfirst(Str::lower($model)));

        return match ($model) {
            'User' => User::class,
            'Brand' => Brand::class,
            'Category' => Category::class,
            'Product' => Product::class,
            'Order' => Order::class,
        };
    }
}
