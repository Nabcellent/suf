<?php

use App\Http\Controllers\API\MpesaController;
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

Route::prefix('stk-push')->name('api.')->namespace('Api')->group(function() {
    Route::name('mpesa.')->group(function() {
        Route::post('v1/access/token', [MpesaController::class, 'generateAccessToken']);
        Route::post('v1/hlab/stk/push', [MpesaController::class, 'STKPush'])->name('push');
        Route::post('/confirmation', [MpesaController::class, 'confirm'])->name('callback');
    });
});
