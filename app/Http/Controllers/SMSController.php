<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SMSController extends Controller
{
    public function sendSMS(): void
    {
        Nexmo::message()->send([
            'to' => '0110039317',
            'from' => '254110039317',
            'text' => 'This is the text message from SU-F Store'
        ]);

        echo "Message Sent Successfully";
    }
}
