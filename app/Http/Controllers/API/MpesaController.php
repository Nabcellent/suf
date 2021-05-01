<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use stdClass;
use SmoDav\Mpesa\Laravel\Facades\STK;


class MpesaController extends Controller
{
    /**
     * @throws \JsonException
     */
    public function generateAccessToken() {
        $credentials = base64_encode(env('MPESA_CONSUMER_KEY') . ':' .env('MPESA_CONSUMER_SECRET'));
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);

        return json_decode($curl_response) ->access_token;
    }

    /**
     * @throws \JsonException
     */
    public function STKPush() {
        try {
            $request = STK::push(1, 254110039317, 'SUF-PAYMENT', 'Test Payment');
        } catch(Exception $e) {
            return $e->getMessage();
        }

        return json_decode(json_encode($request, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }
}
