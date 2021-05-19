<?php

use SmoDav\Mpesa\Laravel\Facades\Identity;
use SmoDav\Mpesa\Laravel\Facades\STK;

if (!function_exists('mpesaIdCheck')) {
    /**
     * @param string $phone
     * @return mixed
     */
    function mpesaIdCheck($callback, int $phone)
    {
        return Identity::validate($phone, $callback);
    }
}
if (!function_exists('mpesaStkStatus')) {
    /**
     * @param int $id
     * @return mixed
     */
    function mpesaStkStatus($id)
    {
        return STK::validate($id);
    }
}
if (!function_exists('mpesaRequest')) {
    /**
     * @param string $phone
     * @param int $amount
     * @param string|null $reference
     * @param string|null $description
     * @return mixed
     */
    function mpesaRequest($phone, $amount, $reference = null, $description = null)
    {
        return STK::push($amount, $phone, $reference, $description);
    }
}
if (!function_exists('mpesaValidate')) {
    /**
     * @param string|int $id
     * @return mixed
     */
    function mpesaValidate($id)
    {
        return STK::validate($id);
    }
}
