<?php

return [
    'continue_url' => config('app.url') . '/payment-summary/',
    'payU' => [
        'oauth_endpoint' => env('PAYU_OAUTH_ENDPOINT'),
        'order_endpoint' => env('PAYU_ORDER_ENDPOINT'),
        'client_id' => env('PAYU_CLIENT_ID'),
        'client_secret' => env('PAYU_CLIENT_SECRET'),
        'pos_id' => env('PAYU_POS_ID'),
        'notify' => config('app.url') . '/api/payu/notify'
    ],
];
