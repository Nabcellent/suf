<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StkPushPaymentFailed
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
     * @param \App\Events\StkPushPaymentFailed $event
     * @return void
     */
    public function handle(\App\Events\StkPushPaymentFailed $event)
    {
        $stk = $event->stk_callback;
        $stk->request()->update(['status' => 'Failed']);
    }
}
