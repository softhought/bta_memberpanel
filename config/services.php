<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'pgpay' => [
        'merchant_id'   => env('PGPAY_MERCHANT_ID', '100000000515382'),
        'aggregator_id' => env('PGPAY_AGGREGATOR_ID', '100000000515381'),
        'secret_key'    => env('PGPAY_SECRET_KEY', '85f4eb97-cb28-4b9b-b49e-54909bf53202'),
        'initiate_url'  => env('PGPAY_INITIATE_URL', 'https://pgpay.icicibank.com/pg/api/v2/initiateSale'),
        'status_url'    => env('PGPAY_STATUS_URL', 'https://pgpay.icicibank.com/pg/api/command'),
        'return_url'    => env('PGPAY_RETURN_URL', 'https://members.btaportal.in/payment-response'),
    ],

];
