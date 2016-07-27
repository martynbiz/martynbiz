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
        $app->get('/hello', function($request, $response, $args) {
            $html = $this->get('renderer')->render('hello');
            $response->getBody()->write($html);
            return $response;
        });

        $app->get('/', '\App\Controller\IndexController:index')->setName('home');

        $app->get('/portfolio', function($request, $response, $args) {
            $html = $this->get('renderer')->render('app/portfolio');
            $response->getBody()->write($html);
            return $response;
        })->setName('portfolio');
    }
}
