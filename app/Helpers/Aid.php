<?php


namespace App\Helpers;


use App\Imports\CodesImport;
use App\Models\Channel;
use App\Models\Code;
use App\Models\PayPalCallback;
use App\Models\Reward;
use App\Models\Setting;
use App\Models\StkRequest;
use App\Models\User;
use App\Models\Video;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Stevebauman\Location\Facades\Location;

class Aid {
    /**
     * Aid constructor.
     */
    public function __construct() { }

    public static function json($msg, $ok = TRUE, $arr = []): JsonResponse {
        return $arr ? response()->json($arr) : response()->json(['ok' => $ok, 'msg' => $msg]);
    }
    public static function jsonStoreOk(): JsonResponse {
        return self::json(__('msg.store_ok'));
    }

    public static function createOk($msg = 'Created successfully!', $routeName = null): RedirectResponse {
        return self::goWithSuccess(__($msg), $routeName);
    }
    public static function updateOk($msg = 'Update successful!', $routeName = null): RedirectResponse {
        return self::goWithSuccess(__($msg), $routeName);
    }
    public static function deleteOk($routeName = null): RedirectResponse {
        return self::goWithSuccess(__('Delete Successful!'), $routeName);
    }

    public static function goWithSuccess($msg, $to = null): RedirectResponse {
        $route = $to ? self::goToRoute($to) : back();

        return $route->with('toast_success', $msg);
    }
    public static function goWithError($to = 'admin.dashboard', $msg = NULL): RedirectResponse {
        $msg = $msg ? $msg : __('msg.rnf');
        return self::goToRoute($to)->with('sweet_error', $msg);
    }

    public static function goToRoute($goto): RedirectResponse {
        $data = [];
        $to = (is_array($goto) ? $goto[0] : $goto) ?: 'dashboard';

        if(is_array($goto)){
            array_shift($goto);
            $data = $goto;
        }

        if(!Route::has($to)) {
            $to = app('router')->getRoutes()->match(app('request')->create($to))->getName();
        }

        return app('redirect')->to(route($to, $data));
    }

    public static function returnToastError($serverError, $clientMessage): RedirectResponse {
        Log::error($serverError);

        return back()->withInput()
            ->with('toast_error', __($clientMessage));
    }

    public static function chartDataSet(\Illuminate\Support\Collection $models, string $string = 'daily' | 'weekly' | 'monthly'): array {
        $date = new Carbon;

        for($i = 0; $i < 7; $i++) {
            $dateString = $date->toDateString();
            isset($models[$dateString]) ? $models[$dateString] = $models[$dateString]->count() : $models[$dateString] = 0;
            $date->subDay();
        }

        $models = $models->sortKeys();

        foreach($models as $key => $order) {
            $models[Carbon::parse($key)->shortDayName] = $order;
            $models->forget($key);
        }

        return [
            'labels' => $models->keys()->toArray(),
            'datasets' => $models->values()->toArray()
        ];
    }
}
