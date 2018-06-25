<?php

return [
    'url' => '',
    'token' => '',
    'mail' => [
        'enable' => false,
        'to' => [],
        'include' => [
            'request' => false,
            'sql' => true,
        ],
    ],
    'dingtalk-bot' => [
        'enable' => false,
        'webhook_url' => '',
        'at' => [
            'enable' => false,
            'isAtAll' => false,
            'atMobiles' => [],
        ],
        'include' => [
            'request' => false,
            'sql' => true,
        ],
    ]
];