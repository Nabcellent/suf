<?php

namespace App\Listeners;

use App\Events\StkPushSuccess;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class StkPushSuccessNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StkPushSuccess  $event
     * @return void
     */
    public function handle(StkPushSuccess $event)
    {
        $stk = $event->stkCallback;

        if(Str::containsAll($event->stkCallback->result_desc, ['cancelled', 'user'])) {
            $status = "Cancelled";
        } else {
            $status = "Paid";

            $order = Order::find(Session::get('orderId'));
            $order->status = 'Paid';
            $order->save();
        }

        $stk->status = $status;
        $stk->save();
    }
}
