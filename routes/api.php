<?php

use App\Http\Controllers\Admin\STKPushController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::group(['prefix' => 'stk-push', 'as', 'stk-push'], function() {
    Route::post('simulate', [STKPushController::class, 'simulate'])->name('simulate');
    Route::post('confirm/{confirmationKey}', [STKPushController::class, 'confirm'])->name('mpesa.confirm');
});*/
