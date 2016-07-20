<?php
// Routes

$app->get('/', '\App\Controller\IndexController:index')->setName('home');
$app->get('/portfolio', '\App\Controller\IndexController:portfolio')->setName('portfolio');
$app->get('/contact', '\App\Controller\IndexController:contact')->setName('contact');
