<?php

namespace App\Events;

use App\Models\StkCallback;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StkPushPaymentSuccess
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var StkCallback
     */
    public StkCallback $stk_callback;
    /**
     * @var array
     */
    public array $mpesa_response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StkCallback $stkCallback, array $response = [])
    {
        $this->stk_callback = $stkCallback;
        $this->mpesa_response = $response;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
