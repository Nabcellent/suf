<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class QueueTimeoutEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Request
     */
    public Request $request;

    /**
     * @var string
     */
    public mixed $initiator;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request, $initiator = null)
    {
        $this->request = $request;
        $this->initiator = $initiator;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
