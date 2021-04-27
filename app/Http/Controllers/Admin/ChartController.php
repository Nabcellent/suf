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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChartController extends Controller {
    public string $model;

    function getCount($day = null, $month = null): array {
        $day = (!$day) ? Carbon::now()->format('d') : $day;
        $month = (!$month) ? Carbon::now()->format('m') : $month;

        if($this->model === "Customer") {
            $dailyCount = User::where('is_admin', 0);
            $monthlyCount = User::where('is_admin', 0);
        } else if($this->model === "Seller") {
            $dailyCount = Admin::where('type', "Seller");
            $monthlyCount = Admin::where('type', "Seller");
        } else if(isSeller()) {
            if($this->model === Order::class) {
                $dailyCount = Order::getSellerOrders();
                $monthlyCount = Order::getSellerOrders();
            } else if($this->model === Product::class) {
                $dailyCount = Product::where('seller_id', Auth::id());
                $monthlyCount = Product::where('seller_id', Auth::id());
            }
        } else {
            $dailyCount = $this->model::query();
            $monthlyCount = $this->model::query();
        }

        return [
            'dailyCount' => $dailyCount->whereDay('created_at', $day)->count(),
            'monthlyCount' => $monthlyCount->whereMonth('created_at', $month)->count()
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

            $maxDay = round((max($dailyCountArr) + 5), -1);
            $maxMonth = round((max($monthlyCountArr) + 5), -1);

            if($maxDay > $maxD) {
                $response['maxDay'] = $maxDay;
                $maxD = $maxDay;
            }
            if($maxMonth > $maxM) {
                $response['maxMonth'] = $maxMonth;
                $maxM = $maxMonth;
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
        $period = CarbonPeriod::create(now()->subDays(6), now());
        $days = [];

        foreach ($period as $date) {
            $days['byNum'][] = $date->format('d');
            $days['byName'][] = $date->format('D');
        }

        return $days;
    }

    public function getLastThreeMonths(): array {
        $period = CarbonPeriod::create(now()->subMonths(2), '1 month', now());
        $dates = [];

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
