<?php

return [
    // Set to false for production environment
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    
    // Midtrans Server Key
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),
    
    // Midtrans Client Key
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    
    // Set sanitization on/off (default on)
    'is_sanitized' => true,
    
    // Set 3DS transaction on/off (default on)
    'is_3ds' => true,
];