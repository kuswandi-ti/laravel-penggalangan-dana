<?php

return [
    'midtrans_merchant_id' => env('MIDTRANS_MERCHANT_ID', ''),
    'midtrans_client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    'midtrans_server_key' => env('MIDTRANS_SERVER_KEY', ''),

    'is_production' => false,
    'is_sanitized' => false,
    'is_3ds' => false,
];
