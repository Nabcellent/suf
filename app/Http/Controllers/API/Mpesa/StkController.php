<?php

namespace App\Http\Controllers\API\Mpesa;

use App\Events\StkPushFailed;
use App\Events\StkRequested;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStkRequest;
use App\Models\StkCallback;
use App\Models\StkRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use SmoDav\Mpesa\Laravel\Facades\STK;

class StkController extends Controller
{
    /**
     * @param StoreStkRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function initiatePush(StoreStkRequest $request): JsonResponse|RedirectResponse {
        $data = $request->all();

        $data['phone'] = "254" . (Str::length($data['phone']) > 9 ? Str::substr($data['phone'], -9) : $data['phone']);
        $data['amount'] = 1/*session('grandTotal')*/;
        $data['reference'] = 'SUF-PAYMENT';
        $data['description'] = 'Payment made to SUF Web store';

        try {
            $stk = STK::request($data['amount'])
                ->from($data['phone'])
                ->usingReference($data['reference'], $data['description'])
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
                $stk = ['ResponseCode' => 700, 'ResponseDescription' => 'Invalid request', 'extra' => 'Unable to process request at this time.'];
            }
        } catch (Exception $exception) {
            $stk = ['ResponseCode' => 900, 'ResponseDescription' => 'Invalid request', 'extra' => $exception->getMessage()];
        }

        return response()->json(['stk' => $stk]);
    }

    /**
     * @param $reference
     * @return JsonResponse
     */
    public function stkStatus($reference): JsonResponse {
        $stkStatus = STK::validate($reference);
        $url = "";

        if(property_exists($stkStatus, 'errorCode')) {
            $status = 'processing';
            $message = 'Waiting for customer approval.';
        } else {
            $status = 'processed';
            $message = $stkStatus;

            //  Check Database
            if(StkCallback::where('checkout_request_id', $reference)->exists()) {
                $status = 'recorded';

                $paymentStatus = StkCallback::where('checkout_request_id', $reference)->first()->status;

                if($paymentStatus === 'Paid') {
                    $message = 'Payment Successful!';
                    $url = route('thank-you');
                    $icon = 'success';
                } else if($paymentStatus === 'Cancelled') {
                    $message = 'Payment Cancelled.';
                    $icon = 'info';
                } else {
                    $message = 'Something did not go right somewhere.';
                    $icon = 'warning';
                }

                return response()->json(['status' => $status, 'message' => $message, 'icon' => $icon,'url' => $url]);
            }
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }
}
