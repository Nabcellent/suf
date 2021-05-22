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

Route::/*middleware(['verified', 'auth'])->*/
prefix('payments/callbacks')->name('mpesa.stk.')->namespace('Mpesa')->group(function () {
    //Route::any('confirmation', 'MpesaController@confirmation');
    Route::any('stk_request', [StkController::class, 'initiatePush'])->name('request');
    Route::any('stk_callback', [MpesaController::class, 'stkCallback']);
    Route::any('timeout_url/{section?}', [MpesaController::class, 'timeout']);
    //Route::any('validate', 'MpesaController@validatePayment');
    //Route::any('result/{section?}', 'MpesaController@result');
    Route::get('stk_status/{id}', [StkController::class, 'stkStatus']);
});
