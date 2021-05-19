<?php

use App\Http\Controllers\API\Mpesa\MpesaController;
use App\Http\Controllers\API\Mpesa\StkController;
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

Route::group([
    'prefix' => 'payments/callbacks',
    'namespace' => 'Mpesa'
], function () {
    Route::any('validate', 'MpesaController@validatePayment');
    Route::any('confirmation', 'MpesaController@confirmation');
    Route::any('stk_callback', [MpesaController::class, 'stkCallback']);
    Route::any('timeout_url/{section?}', [MpesaController::class, 'timeout']);
    Route::any('result/{section?}', 'MpesaController@result');
    Route::any('stk_request', [StkController::class, 'initiatePush']);
    Route::get('stk_status/{id}', [StkController::class, 'stkStatus']);
});
