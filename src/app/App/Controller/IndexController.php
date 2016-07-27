<?php
namespace App\Controller;

use MartynBiz\Slim\Module\Core\Controller\BaseController;

class IndexController extends BaseController
{
    public function index($request, $response, $args)
    {
        $container = $this->getContainer();

        $articles = $container->get('blog.model.article')->find([
            //..
        ], [ 'limit' => 5 ]);

        $carouselPhotos = $container->get('blog.model.photo')->find([
            //..
        ], [ 'limit' => 5 ]);


        $this->render('app/index/index', compact('articles', 'carouselPhotos'));
    }
}
