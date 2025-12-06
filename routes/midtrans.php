<?php

return [
    'serverKey' => env('MIDTRANS_SERVER_KEY', ''),
    'isProduction' => env('MIDTRANS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
];
