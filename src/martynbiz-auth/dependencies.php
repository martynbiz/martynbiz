<?php
// DIC configuration

$container = $app->getContainer();

// Models
$container['auth.model.user'] = function ($c) {
    return new MartynBiz\Auth\Model\User();
};

$container['auth'] = function ($c) {
    $settings = $c->get('settings')['auth'];
    $authAdapter = new MartynBiz\Auth\Adapter\Mongo( $c['auth.model.user'] );
    return new MartynBiz\Auth\Auth($authAdapter, $settings);
};
