<?php

namespace App\Misc\Overrides\Mpesa\Traits;

use Illuminate\Support\Str;
use InvalidArgumentException;

trait Validates
{
    /**
     * Check if the provided number is valid.
     *
     * @param string $number
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    protected function validateNumber($number): void {
        if (!Str::startsWith($number, '2547') && !Str::startsWith($number, '2541')) {
            throw new InvalidArgumentException('The subscriber number must begin with 2541 or 2547');
        }
    }

    /**
     * Check if the amount is numeric.
     *
     * @param string|int|float $amount
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    protected function validateAmount($amount): void {
        if (!is_numeric($amount)) {
            throw new InvalidArgumentException('The amount must be numeric');
        }
    }
}
