<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
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
    protected array $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, array $user) {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self {
        if($this->user['gender'] === 'Male') {
            $icons = ["hello" => "😁", "relax" => "💆🏽‍♂️", "thanks" => "💪🏽"];
        } else {
            $icons = ["hello" => "✨", "relax" => "💆🏼‍♀️", "thanks" => "🤗"];
        }

        return $this->subject('Order Placed')->from('su.fashion10@gmail.com')
            ->markdown('emails.orders.placed', [
                'firstName' => $this->user['first_name'],
                'order' => $this->order,
                'url' => route('profile', ['page' => 'orders']),
                'icons' => $icons
            ]);
    }
}
