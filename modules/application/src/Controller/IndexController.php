<?php
namespace App\Controller;

use MartynBiz\Slim\Module\Core\Controller\BaseController;

class IndexController extends BaseController
{
    public function index($request, $response, $args)
    {
        $this->render('application::index/index');
    }
}
