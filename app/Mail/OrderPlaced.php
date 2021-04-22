<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected Order $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        if(Auth::user()->gender === 'Male') {
            $icons = ["hello" => "😁", "relax" => "💆🏽‍♂️", "thanks" => "💪🏽"];
        } else {
            $icons = ["hello" => "✨", "relax" => "💆🏼‍♀️", "thanks" => "🤗"];
        }

        return $this->subject('Order Placed')->from('su.fashion10@gmail.com')
            ->markdown('emails.orders.placed', [
                'user' =>Auth::user(),
                'order' => $this->order,
                'url' => route('profile', ['page' => 'orders']),
                'icons' => $icons
            ]);
    }
}
