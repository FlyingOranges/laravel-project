<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => false,
    'allowedOrigins' => ['http://127.0.0.1:3000'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => [
        'Origin', 'Content-Type', 'Cookie', 'X-CSRF-TOKEN',
        'Accept', 'Authorization', 'X-XSRF-TOKEN', 'X-Requested-With'
    ],
    'allowedMethods' => ['GET', 'POST', 'PATCH', 'PUT', 'OPTIONS'],
    'exposedHeaders' => ['Authorization, authenticated'],
    'maxAge' => 0,

];
