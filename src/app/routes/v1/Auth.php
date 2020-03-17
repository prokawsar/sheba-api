<?php

return [
    'routes' => [
        'head' => [
            '/' => null,
            '/@id' => null,
            '/@context' => 'get',
            '/@context/@context_id' => 'get',
        ],

        'get' => [
            '/' => null,
            '/@id' => null,
            '/token' => 'getToken',
            '/@context' => 'get',
            '/@context/@context_id' => 'get',
        ],
        'put' => null,
        'delete' => null,
        'post' => [
            '/' => 'post',
            '/reset_password' => 'resetPassword'
        ],
    ]
];
