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


// ==================================
// Instantiate the app

// Compile app settings
// $settings = require APPLICATION_PATH . '/src/settings.php';
$settings = [];
if ($path = realpath(APPLICATION_PATH . '/src/settings.' . APPLICATION_ENV . '.php')) {
    $settings = array_merge_recursive($settings, require $path);
}

// Compile module settings
$modulePaths = array_filter(glob(APPLICATION_PATH . '/src/*'), 'is_dir');
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/settings.php')) {
        $settings = array_merge_recursive($settings, require $path);
    }
}

$app = new \Slim\App($settings);


// ==================================
// Set up dependencies

// // Load app dependencies
// require APPLICATION_PATH . '/src/dependencies.php';

// Load module dependencies
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/dependencies.php')) {
        require $path;
    }
}

// ==================================
// Register middleware

// // Load app middleware
// require APPLICATION_PATH . '/src/middleware.php';

// Load module middleware
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/middleware.php')) {
        require $path;
    }
}

// ==================================
// Register routes

// // Load app routes
// require APPLICATION_PATH . '/src/routes.php';

// Load module routes
foreach ($modulePaths as $modulePath) {
    if ($path = realpath($modulePath . '/routes.php')) {
        require $path;
    }
}


// ==================================
// Run app
$app->run();
