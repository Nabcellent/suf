<?php

return [
    'env' => env('MPESA_ENVIRONMENT', 'sandbox'),
    'stk_push' => [
        'sandbox' => [
            'passkey' => env('MPESA_ONLINE_PASS_KEY'),
            'confirmation_key' => env('CONFIRMATION_KEY'),
            'short_code' => env('MPESA_ONLINE_SHORTCODE')
        ]
    ]
];
