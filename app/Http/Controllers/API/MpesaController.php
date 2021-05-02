<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StkCallback;
use App\Models\StkRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SmoDav\Mpesa\Laravel\Facades\STK;


class MpesaController extends Controller
{
    /**
     * @throws \JsonException
     */
    public function initiatePush(Request $request): JsonResponse {
        try {
            $request->validate([
                'phone' => 'required'
            ]);

            $data = $request->all();
            $phone = Str::length($data['phone']) > 9 ? Str::substr($data['phone'], -9) : $data['phone'];
            $data['phone'] = "254$phone";
            $data['amount'] = 1/*session('grandTotal')*/;
            $data['reference'] = 'SUF-PAYMENT'/*session('grandTotal')*/;

            $pushRequest = STK::request($data['amount'])
                ->from($data['phone'])
                ->usingReference($data['reference'], 'Test Payment')
                ->push();

            $response = json_decode(json_encode($pushRequest, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

            $data['user_id'] = 1;
            $data['merchant_request_id'] = $response['MerchantRequestID'];
            $data['checkout_request_id'] = $response['CheckoutRequestID'];

            DB::transaction(function() use ($data) {
                StkRequest::create($data);
            });
        } catch(Exception $e) {
            $pushRequest = $e->getMessage();
        }

        return response()->json($pushRequest);
    }

    public function processStkCallback(Request $request): void {
        $data = $request->Body['stkCallback'];

        $realData = [
            'merchant_request_id' => $data['MerchantRequestID'],
            'checkout_request_id' => $data['CheckoutRequestID'],
            'result_code' => $data['ResultCode'],
        ];

        if($data['ResultCode'] === 0) {
            $payLoad = Arr::collapse($data)['Item'];

            $realData['stk_request_id'] = 1;
            $realData['amount'] = $payLoad[0]['Value'];
            $realData['receipt_number'] = $payLoad[1]['Value'];
            $realData['status'] = 'Success';
        } else if($data['ResultCode'] === 1032) {
            $realData['status'] = 'Cancelled';
        } else {
            $realData['status'] = 'Failed';
        }

        DB::transaction(function() use ($realData) {
            StkCallback::create($realData);
        });
    }
}
