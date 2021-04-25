<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MpesaSTKPushSimulateRequest;
use App\Misc\STKPush;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class STKPushController extends Controller
{
    private $resultDesc = "An Error occurrd";
    private $resultCode = 1;
    private $httpCode = 400;

    public function simulate(MpesaSTKPushSimulateRequest $request): JsonResponse {
        $env = config('Misc.mpesa.env', 'sandbox');

        if($config = config("Misc.mpesa.stk_push.{$env}")) {
            $stkPushSimulator = (new STKPush())
                ->setShortCode($config['short_code'])
                ->setPassKey($config['pass_key'])
                ->setAmount($request->amount)
                ->setPartyA($request->sender_phone)
                ->setPhoneNumber($request->payer_phone)
                ->setAccountReference($request->account_reference)
                ->setPartyB($config['short_code'])
                ->setCallbackUrl( route('mpesa.confirm', $config['confirmation_key']))
                ->simulate($env);

            if(!$stkPushSimulator->failed()) {
                $this->httpCode = 200;
            }

            $this->resultDesc = $stkPushSimulator->getResponse();
        } elseif(!config()) {
            $this->resultDesc = "STK PUSH Request Failed: Missing important parameter(s)";
        }

        return response()->json([
            'message' => $this->resultDesc
        ], $this->httpCode);
    }

    public function confirm(Request $request) {
        $env = config('Misc.mpesa.env', 'sandbox');
        $confirmationKey = config("Misc.mpesa.stk_push.{$env}.confirmationKey");

        if($request->confirmation_key === $confirmationKey) {
            $stkPushConfirm = (new STKPush())->confirm($request);

            if($stkPushConfirm->failed()) {
                Log::error($stkPushConfirm->getResponse());
            } else {
                $this->resultCode = 0;
                $this->resultDesc = "Success";
            }
        } else {
            $this->resultDesc = "STK PUSH confirmation failed: confirmation key mismatch";

            Log::error($this->resultDesc);
        }

        return response()->json([
            'resultCode' => $this->resultCode,
            'resultDesc' => $this->resultDesc
        ]);
    }
}
