<?php

namespace App\Listeners;

use App\Events\StkPushFailed;
use Illuminate\Support\Str;

class StkPushFailedNotification
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
     * @param  StkPushFailed  $event
     * @return void
     */
    public function handle(StkPushFailed $event)
    {
        $stk = $event->stkCallback;

        if(Str::containsAll($event->stkCallback->result_desc, ['cancelled', 'user'])) {
            $status = "Cancelled";
        } else {
            $status = "Failed";
        }

        $stk->request()->update(['status' => $status]);
    }
}
