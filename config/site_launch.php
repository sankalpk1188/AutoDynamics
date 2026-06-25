<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site launch gate
    |--------------------------------------------------------------------------
    | Set SITE_LAUNCH_ENABLED=true in .env to show the maintenance page until
    | SITE_LAUNCH_AT. After that time the full website opens automatically.
    */

    'enabled' => env('SITE_LAUNCH_ENABLED', false),

    'launch_at' => env('SITE_LAUNCH_AT', '2026-06-23 11:30:00'),

    'timezone' => env('SITE_LAUNCH_TIMEZONE', 'Asia/Kolkata'),

    'image' => env('SITE_LAUNCH_IMAGE', 'assets/images/site-launch/maintenance.png'),

    'title' => env('SITE_LAUNCH_TITLE', 'Auto Dynamic Technologies & Solutions'),

    'message' => env(
        'SITE_LAUNCH_MESSAGE',
        "Our new website launch is almost here.\nThank you for your patience — we'll be live very soon."
    ),

    /*
    | URL path prefixes that stay accessible before launch (admin, auth, etc.)
    */
    'bypass_prefixes' => [
        'admin',
        'admin-login',
        'admin-login-check',
        'login',
        'logout',
        'forgot-password',
        'reset-password',
        'changePassword',
        'clear',
        'site-launch',
    ],

];
