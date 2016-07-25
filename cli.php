<?php

require_once 'public/prepare.php';

switch ($argv[1]) {
    case 'modules:install':
        foreach($settings['settings']['module_initializer']['modules'] as $name => $moduleClassName) {
            $module = new $moduleClassName();
            if (method_exists($module, 'copyFiles')) {
                echo '  Copying ' . $name . ' files' . PHP_EOL;
                $module->copyFiles(__DIR__);
            }
        }
        break;
}
