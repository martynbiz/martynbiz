<?php
/**
 * This include file allows this code to be shared with the website and cli tool
 */

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

$classLoader = require __DIR__ . '/../vendor/autoload.php';

// App settings
$appSettings = require APPLICATION_PATH . '/modules/settings.php';

// Module settings (autoload)
$moduleSettings = [];
foreach (array_keys($appSettings['settings']['module_initializer']['modules']) as $dir) {
    if ($path = realpath($appSettings['settings']['modules_dir'] . $dir . '/settings.php')) {
        $moduleSettings = array_merge_recursive($moduleSettings, require $path);
    }
}

// Environment settings
$envSettings = [];
if ($path = realpath(APPLICATION_PATH . '/modules/settings.' . APPLICATION_ENV . '.php')) {
    $envSettings = require $path;
}

// Instantiate the app
$settings = array_merge_recursive($moduleSettings, $appSettings, $envSettings);
$app = new Slim\App($settings);
