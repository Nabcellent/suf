<?php

namespace App\Listeners;

use App\Events\StkRequested;

class ConfirmStkRequestStatus
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
     * @param  StkRequested  $event
     * @return void
     */
    public function handle(StkRequested $event)
    {
        //Log::alert(json_encode(STK::validate($event->stk->checkout_request_id)));
    }
}
