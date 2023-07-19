<?php

return [
    'midtrans_merchant_id' => env('MIDTRANS_MERCHANT_ID', ''),
    'midtrans_client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    'midtrans_server_key' => env('MIDTRANS_SERVER_KEY', ''),
    'midtrans_snap_url' => env('MIDTRANS_SNAP_URL', ''),

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => false,
    'is_3ds' => true,
];
