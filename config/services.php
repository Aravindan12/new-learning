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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '533651979597-kilvm3u5tng1thvilob919gdec3undq0.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
    ],
    'stripe' => [
        'model' => App\Models\Stripe::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
      ],
];
