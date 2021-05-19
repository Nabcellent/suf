<?php

namespace App\Http\Controllers\API\Mpesa;

use App\Events\StkPushFailed;
use App\Events\StkRequested;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStkRequest;
use App\Models\StkCallback;
use App\Models\StkRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SmoDav\Mpesa\Laravel\Facades\STK;

class StkController extends Controller
{
    /**
     * @param StoreStkRequest $request
     * @return JsonResponse
     */
    public function initiatePush(StoreStkRequest $request): JsonResponse {
        $data = $request->all();

        $data['phone'] = "254" . (Str::length($data['phone']) > 9 ? Str::substr($data['phone'], -9) : $data['phone']);
        $data['amount'] = 1/*session('grandTotal')*/;
        $data['reference'] = 'SUF-PAYMENT'/*session('grandTotal')*/;

        try {
            $stk = STK::request($data['amount'])
                ->from($data['phone'])
                ->usingReference($data['reference'], $request->description)
                ->push();

            if(property_exists($stk, 'ResponseCode')) {
                $data['user_id'] = 1;
                $data['merchant_request_id'] = $stk->MerchantRequestID;
                $data['checkout_request_id'] = $stk->CheckoutRequestID;

                $stkRequest = DB::transaction(function() use ($data) {
                    return StkRequest::create($data);
                });

                StkRequested::dispatch($stkRequest, $request);
            } else {
                echo json_encode($stk);
            }
        } catch (Exception $exception) {
            $stk = ['ResponseCode' => 900, 'ResponseDescription' => 'Invalid request', 'extra' => $exception->getMessage()];
        }

        return response()->json($stk);
    }

    /**
     * @param $reference
     * @return JsonResponse
     */
    public function stkStatus($reference): JsonResponse {
        return response()->json(STK::validate($reference));
    }
}
