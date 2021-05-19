<?php

namespace App\Events;

use App\Models\StkCallback;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StkPushFailed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var StkCallback
     */
    public StkCallback $stkCallback;
    /**
     * @var array
     */
    public array $mpesaResponse;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StkCallback $stkCallback, array $response = [])
    {
        $this->stkCallback = $stkCallback;
        $this->mpesaResponse = $response;
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
