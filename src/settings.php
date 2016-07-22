<?php

// App settings
$appSettings = [
    'settings' => [
        'module_dir' => APPLICATION_PATH . '/src/',
        'module_initializer' => [
            'modules' => [
                'martynbiz-core' => 'MartynBiz\\Slim\\Modules\\Core\\Module',
                // 'martynbiz-auth' => 'MartynBiz\\Slim\\Modules\\Auth\\Module',
                // 'martynbiz-blog' => 'MartynBiz\\Slim\\Modules\\Blog\\Module',
            ],
        ],
    ],
];

// Module Settings
$moduleSettings = [];
foreach ($appSettings['settings']['module_initializer'] as $moduleName => $moduleClassName) {
    if ($path = realpath($appSettings['settings']['module_dir'] . $moduleName . '/settings.php')) {
        $moduleSettings = require $path;
    }
}

// Environment settings
$envSettings = [];
if ($path = realpath(APPLICATION_PATH . '/src/settings.' . APPLICATION_ENV . '.php')) {
    $envSettings = require $path;
}

return array_merge_recursive($moduleSettings, $appSettings, $envSettings);
