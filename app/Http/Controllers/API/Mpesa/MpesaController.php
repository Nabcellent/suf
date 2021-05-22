<?php

namespace App\Http\Controllers\API\Mpesa;

use App\Events\QueueTimeoutEvent;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Repositories\Mpesa;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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

    public function show(): View|Factory|Redirector|RedirectResponse|Application {
        if(session::has('orderId')) {
            //  Empty User Cart
            Cart::where('user_id', Auth::id())->delete();

            return view('API.mpesa');
        }

        return redirect('/cart');
    }

    public function showCart(): Redirector|Application|RedirectResponse {
        session::forget(['grandTotal', 'orderId', 'couponId', 'couponDiscount']);

        return redirect('cart');
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
        $this->repository->notification('MPESA STK Callback: *STK*', true);
        $this->repository->processStkPushCallback(json_encode($request->Body));

        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'STK Callback received successfully',
        ];

        return response()->json($resp);
    }
}
