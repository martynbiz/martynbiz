<?php

// App settings
$appSettings = [
    'settings' => [
        'autoload_dir' => APPLICATION_PATH . '/src/autoload/',
        'module_initializer' => [
            'modules' => [
                'martynbiz-core' => 'MartynBiz\\Slim\\Modules\\Core\\Module',
                'martynbiz-auth' => 'MartynBiz\\Slim\\Modules\\Auth\\Module',
                'martynbiz-blog' => 'MartynBiz\\Slim\\Modules\\Blog\\Module',
            ],
        ],
    ],
];

// Module Settings
// $moduleSettings = [];
// foreach ($appSettings['settings']['module_initializer']['modules'] as $moduleName => $moduleClassName) {
// 	if ($path = realpath($appSettings['settings']['module_dir'] . $moduleName . '/settings.php')) {
//         $moduleSettings = array_merge_recursive($moduleSettings, require $path);
//     }
// }

$moduleSettings = [];
foreach (scandir($appSettings['settings']['autoload_dir']) as $file) {
    if ('.' === $file) continue;
    if ('..' === $file) continue;

    $moduleSettings = array_merge_recursive($moduleSettings, require $appSettings['settings']['autoload_dir'] . $file);
}

// Environment settings
$envSettings = [];
if ($path = realpath(APPLICATION_PATH . '/src/settings.' . APPLICATION_ENV . '.php')) {
    $envSettings = require $path;
}

return array_merge_recursive($moduleSettings, $appSettings, $envSettings);
