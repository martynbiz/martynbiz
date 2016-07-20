<?php

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

require __DIR__ . '/../vendor/autoload.php';

session_start();

// get directories within /src
$modulePaths = array_filter(glob(APPLICATION_PATH . '/src/*'), 'is_dir');

// Instantiate the app
$settings = [];
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/settings.php')) {
        $settings = array_merge_recursive($settings, require $path);
    }
    if ($path = realpath($modulePath . '/settings.' . APPLICATION_ENV . '.php')) {
        $settings = array_merge_recursive($settings, require $path);
    }
}

// var_dump($settings); exit;
$app = new \Slim\App($settings);

MartynBiz\Mongo\Connection::getInstance()->init($settings['settings']['mongo']);

// Set up dependencies
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/dependencies.php')) {
        require $path;
    }
}

// Register middleware
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/middleware.php')) {
        require $path;
    }
}

// Register routes
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/routes.php')) {
        require $path;
    }
}

// Run app
$app->run();
