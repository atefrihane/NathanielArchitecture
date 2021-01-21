<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Google Analytics
    |--------------------------------------------------------------------------
    |
    | These options configure Google Analytics. Set your personal analytics
    | tracking id. You may also make use of the anonymize ip functionality.
    |
    */
    'google_analytics' => [
        'tracking_id' => env('GOOGLE_ANALYTICS_TRACKING_ID'),
        'anonymize_ip' => env('GOOGLE_ANALYTICS_ANONYMIZE_IP', false),
    ],
];
