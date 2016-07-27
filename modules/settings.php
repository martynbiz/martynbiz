<?php

return [
    'settings' => [
        'modules_dir' => APPLICATION_PATH . '/modules/',
        'module_initializer' => [
            'modules' => [
                'application' => 'App\\Module',
                'martynbiz-core' => 'MartynBiz\\Slim\\Module\\Core\\Module',
            ],
        ],
    ],
];
