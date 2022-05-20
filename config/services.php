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
        'client_id' => '1074814876608-sanhjq5qm63ugqsi6qcdd46bht3frmsq.apps.googleusercontent.com',
        'client_secret' => 'QkJ8A_0BYmxr_EU9YoPbsexf',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
    ],
    'pusher' => [
        'beams_instance_id' => '8b098f77-115e-4186-b0de-480550b66451',
        'beams_secret_key' => 'CC2F9173B771592B42317BD34FD94C567B0AF402C8A61B249FA7E6CCFFC21143',
    ],
];
