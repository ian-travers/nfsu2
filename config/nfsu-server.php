<?php

return [
    /*
    |--------------------------------------------------------------------------
    | NFSU Server IP
    |--------------------------------------------------------------------------
    |
    | This value is the of NFSU Server IP for monitoring in your application.
    |
    */
    'ip' => env('NFSU_SERVER_IP', '127.0.0.1'),

    /*
    |--------------------------------------------------------------------------
    | NFSU Server Port
    |--------------------------------------------------------------------------
    |
    | This value is the of NFSU Server PORT for monitoring in your application.
    | Usually it equals 10980.
    |
    */
    'port' => env('NFSU_SERVER_PORT', '10980'),

    /*
    |--------------------------------------------------------------------------
    | NFSU Server Data Path
    |--------------------------------------------------------------------------
    |
    | This value is the path to NFSU Server Data Files.
    | Ratings and Best Performers depends on those files.
    |
    */
    'path' => env('NFSU_SERVER_DATA_PATH'),
];
