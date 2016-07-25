<?php

require_once 'public/prepare.php';

$modules = $settings['settings']['module_initializer']['modules'];

switch ($argv[1]) {
    case 'modules:install':
        $moduleToInstall = @$argv[2];
        if ($moduleToInstall) {
            $moduleClassName = $modules[$moduleToInstall];
            $module = new $moduleClassName();
            if (method_exists($module, 'copyFiles')) {
                $module->copyFiles(__DIR__);
            }
        } else {
            foreach($modules as $name => $moduleClassName) {
                $module = new $moduleClassName();
                if (method_exists($module, 'copyFiles')) {
                    $module->copyFiles(__DIR__);
                }
            }
        }
        break;
    case 'modules:remove':
        $moduleToRemove = @$argv[2];
        if ($moduleToRemove) {
            $moduleClassName = $modules[$moduleToRemove];
            $module = new $moduleClassName();
            if (method_exists($module, 'removeFiles')) {
                $module->removeFiles(__DIR__);
            }
        } else {
            foreach($modules as $name => $moduleClassName) {
                $module = new $moduleClassName();
                if (method_exists($module, 'removeFiles')) {
                    $module->removeFiles(__DIR__);
                }
            }
        }
        break;
}
