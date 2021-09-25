<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public array $details;

    /**
     * Create a new message instance.
     *
     * @param array $details
     * @return void
     */
    public function __construct(array $details) {
        $this -> details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self {
        $email = $this->details['email'];

        return $this->from($email, $this->details['last_name'] ?? $this->details['first_name'])
            ->subject($this->details['subject'] ?? 'SUF-CONTACT')
            ->replyTo($this->details['email'])
            ->markdown('emails.contact_us');
    }
}
