<?php

return [
    'headers' => [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin, Authorization',
        'Access-Control-Allow-Credentials' => 'true',
    ],
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,
];
