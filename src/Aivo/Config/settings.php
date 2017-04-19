<?php
return [
    'settings' => [
        'displayErrorDetails'    => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name'  => 'slim-app',
            'path'  => __DIR__ . '/../../../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        // Facebook SKD Settings
        'facebookSDK'               => [
            'app_id'                => '',
            'app_secret'            => '',
            'default_graph_version' => 'v2.5'
        ]
    ],
];
