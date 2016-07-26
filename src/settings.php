<?php

return [
    'settings' => [
        'autoload_dir' => APPLICATION_PATH . '/src/autoload/',
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
