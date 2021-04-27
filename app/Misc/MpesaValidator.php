<?php


namespace App\Misc;


class MpesaValidator {
    protected $defaultEndpoints = [];
    protected $endpoint = null;

    protected function validateEndpoints(string $env): void {
        if(!$this->endpoint) {
            if(!array_key_exists($env, $this->defaultEndpoints)) {
                throw new \ErrorException('Endpoint Missing');
            }

            $this->endpoint = $this->defaultEndpoints[$env];
        }
    }
}
