<?php


namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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
    public static function createFail($msg = 'Creation Failed!', $routeName = null): RedirectResponse {
        return self::goWithError(__($msg), $routeName);
    }
    public static function updateOk($msg = 'Update successful!', $routeName = null): RedirectResponse {
        return self::goWithSuccess(__($msg), $routeName);
    }
    public static function updateFail($msg = 'Update failed!', $routeName = null): RedirectResponse {
        return self::goWithError(__($msg), $routeName);
    }
    public static function deleteOk($routeName = null): RedirectResponse {
        return self::goWithSuccess(__('Delete Successful!'), $routeName);
    }

    public static function goWithSuccess($msg, $to = null): RedirectResponse {
        $route = $to ? self::goToRoute($to) : back();

        return $route->with('toast_success', $msg);
    }
    public static function goWithError($msg = "Error...! ☹", $to = null): RedirectResponse {
        $route = $to ? self::goToRoute($to) : back();

        return $route->with('toast_error', $msg);
    }

    public static function goToRoute($goto): RedirectResponse {
        $data = [];
        $to = (is_array($goto) ? $goto[0] : $goto) ?: 'admin.dashboard';

        if(is_array($goto)){
            array_shift($goto);
            $data = $goto;
        }

        if(!Route::has($to)) {
            $to = app('router')->getRoutes()->match(app('request')->create($to))->getName();
        }

        return app('redirect')->to(route($to, $data));
    }

    public static function notFound($routeName = null, $msg = 'Unable to find resource!'): RedirectResponse {
        return self::goWithError(__($msg), $routeName);
    }

    public static function toastError($serverError, $clientMessage): RedirectResponse {
        Log::error($serverError);

        return back()->withInput()
            ->with('toast_error', __($clientMessage));
    }

    public static function returnToastError($serverError, $clientMessage): RedirectResponse {
        Log::error($serverError);

        return back()->withInput()
            ->with('toast_error', __($clientMessage));
    }
}
