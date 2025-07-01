<?php

return [
    'property_id' => env('GA_PROPERTY_ID'), // <- ID GA4 kamu di .env

    'credentials' => storage_path('app/analytics/service-account-credentials.json'),

    'cache_lifetime_in_minutes' => 60 * 24,

    'cache' => [
        'store' => 'file',
    ],
];
