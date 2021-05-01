<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\STKPush;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;
use SmoDav\Mpesa\Laravel\Facades\STK;


class MpesaController extends Controller
{
    /**
     * @throws \JsonException
     */
    public function STKPush(Request $request): void {
        $data = $request->all();
        $phone = Str::length($data['phone']) > 9 ? Str::substr($data['phone'], -9) : $data['phone'];
        $data['phone'] = "254$phone";

        try {
            $pushRequest = STK::push(1, $data['phone'], 'SUF-PAYMENT', 'Test Payment');
        } catch(Exception $e) {
            echo $e->getMessage();
        }

        $response = json_decode(json_encode($pushRequest, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

        $data['user_id'] = 1;
        $data['merchant_request_id'] = $response['MerchantRequestID'];
        $data['checkout_request_id'] = $response['CheckoutRequestID'];

        DB::transaction(function() use ($data) {
            STKPush::create($data);
        });
    }

    public function confirm(Request $request): void {
        $data = $request->Body['stkCallback'];

        $fillable = [
            'merchant_request_id' => $data['MerchantRequestID'],
            'checkout_request_id' => $data['CheckoutRequestID'],
        ];

        $push = STKPush::firstWhere('checkout_request_id', $data['CheckoutRequestID']);

        if($data['ResultCode'] === 0) {
            $item = Arr::collapse($data)['Item'];

            $fillable['amount'] = $item[0]['Value'];
            $fillable['receipt_number'] = $item[1]['Value'];
            $fillable['status'] = 'Success';
        } else if($data['ResultCode'] === 1032) {
            $fillable['status'] = 'Cancelled';
        } else {
            $fillable['status'] = 'Failed';
        }

        DB::transaction(function() use ($push, $fillable) {
            $push->STKCallBack()->create($fillable);
        });
    }
}
