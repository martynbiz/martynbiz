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
$appSettings = require APPLICATION_PATH . '/src/settings.php';

// Module settings (autoload)
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

// Instantiate the app
$settings = array_merge_recursive($moduleSettings, $appSettings, $envSettings);
$app = new Slim\App($settings);