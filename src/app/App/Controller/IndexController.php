<?php
namespace App\Controller;

class IndexController extends BaseController
{
    public function index($request, $response, $args)
    {
        $this->render('app/index/index');
    }

    public function portfolio($request, $response, $args)
    {
        return $this->render('app/index/portfolio');
    }

    public function contact($request, $response, $args)
    {
        return $this->render('app/index/contact');
    }
}
