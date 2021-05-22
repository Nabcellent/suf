<?php

namespace App\Listeners;

use App\Events\StkRequested;
use App\Models\StkRequest;
use Illuminate\Support\Facades\DB;

class StkPushRequestedNotification
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
        $stkRequest = $event->stkRequest;

        $stkRequest->status = 'Requested';
        $stkRequest->save();
    }
}
