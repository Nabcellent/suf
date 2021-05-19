<?php

namespace App\Listeners;

use App\Events\StkPushSuccess;
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
        }

        $stk->request()->update(['status' => $status]);
    }
}
