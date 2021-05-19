<?php

namespace App\Http\Controllers\API\Mpesa;

use App\Events\QueueTimeoutEvent;
use App\Http\Controllers\Controller;
use App\Repositories\Mpesa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    /**
     * @var Mpesa
     */
    private Mpesa $repository;

    /**
     * MpesaController constructor.
     * @param Mpesa $repository
     */
    public function __construct(Mpesa $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param string|null $initiator
     * @return JsonResponse
     */
    public function timeout(Request $request, string $initiator = null): JsonResponse {
        $this->repository->notification('Queue timeout: *' . $initiator . '*');

        QueueTimeoutEvent::dispatch($request, $initiator);

        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function stkCallback(Request $request): JsonResponse {
        Log::info('called');

        $this->repository->notification('MPESA STK Callback: *STK*', true);
        $this->repository->processStkPushCallback(json_encode($request->Body));

        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'STK Callback received successfully',
        ];

        return response()->json($resp);
    }
}
