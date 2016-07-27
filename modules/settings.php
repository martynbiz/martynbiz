<?php

return [
    'settings' => [
        'modules_dir' => APPLICATION_PATH . '/modules/',
        'module_initializer' => [
            'modules' => [
                'martynbiz-core' => 'MartynBiz\\Slim\\Module\\Core\\Module',
                'martynbiz-auth' => 'MartynBiz\\Slim\\Module\\Auth\\Module',
                'martynbiz-blog' => 'MartynBiz\\Slim\\Module\\Blog\\Module',
                'app' => 'App\\Module',
            ],
        ],
    ],
];
