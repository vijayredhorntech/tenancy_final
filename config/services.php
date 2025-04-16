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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    
    'travellanda' => [
        'username' => env('TRAVELLANDA_USERNAME'),
        'password' => env('TRAVELLANDA_PASSWORD'),
        'endpoint' => env('TRAVELLANDA_ENDPOINT'),
        'enabled' => env('ENABLE_TRAVELLANDA', false),
    ],

    'stuba' => [
        'username' => env('STUBA_USERNAME'),
        'password' => env('STUBA_PASSWORD'),
        'endpoint' => env('STUBA_ENDPOINT'),
        'enabled' => env('ENABLE_STUBA', false),
    ],

    'rate_hawk' => [
        'key_id' => env('RATEHAWK_KEY_ID'),
        'key_type' => env('RATEHAWK_KEY_TYPE'),
        'api_key' => env('RATEHAWK_API_KEY'),
        'endpoint' => env('RATEHAWK_ENDPOINT'),
        'enabled' => env('ENABLE_RATEHAWK', false),
    ],

];
