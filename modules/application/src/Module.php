<?php
namespace App;

use Slim\App;
use Slim\Container;
use MartynBiz\Slim\Module\ModuleInterface;

class Module implements ModuleInterface
{
    /**
     * {@inheritdoc}
     */
    public function initDependencies(Container $container)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function initMiddleware(App $app)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function initRoutes(App $app)
    {
        $app->get('/', '\App\Controller\IndexController:index')->setName('home');
    }

    /**
     * Removes files from the project tree
     * @param string $dest The root of the project
     * @return void
     */
    public function removeFiles($dest)
    {
        if ($path = realpath("$dest/martynbiz-app")) {
            shell_exec("rm -rf $path");
        }
    }
}
