<?php
// Routes

// $app->get('/session', '\MartynBiz\MartynBiz\Auth\Controller\SessionController:index')->setName('session_index');

$container = $app->getContainer();

$app->group('/auth', function () use ($app) {

    $app->post('',
        '\MartynBiz\Auth\Controller\SessionController:post')->setName('auth_session_post');
    $app->delete('',
        '\MartynBiz\Auth\Controller\SessionController:delete')->setName('auth_session_delete');
    $app->get('/login',
        '\MartynBiz\Auth\Controller\SessionController:index')->setName('auth_session_login');
    $app->get('/logout',
        '\MartynBiz\Auth\Controller\SessionController:index')->setName('auth_session_logout');

    $app->get('/register',
        '\MartynBiz\Auth\Controller\UsersController:create')->setName('auth_users_create');
    $app->post('/register',
        '\MartynBiz\Auth\Controller\UsersController:post')->setName('auth_users_post');
    $app->get('/resetpassword',
        '\MartynBiz\Auth\Controller\UsersController:resetpassword')->setName('auth_users_reset_password');
    $app->post('/resetpassword',
        '\MartynBiz\Auth\Controller\UsersController:resetpassword')->setName('auth_users_reset_password_post');
});

// admin routes -- invokes auth middleware
$app->group('/admin', function () use ($app, $container) {

    // admin/users routes
    $app->group('/users', function () use ($app, $container) {

        $app->get('',
            '\MartynBiz\Auth\Controller\Admin\UsersController:index')->setName('admin_users');
        $app->get('/{id:[0-9]+}',
            '\MartynBiz\Auth\Controller\Admin\UsersController:show')->setName('admin_users_show');
        $app->get('/create',
            '\MartynBiz\Auth\Controller\Admin\UsersController:create')->setName('admin_users_create');
        $app->get('/{id:[0-9]+}/edit',
            '\MartynBiz\Auth\Controller\Admin\UsersController:edit')->setName('admin_users_edit');

        $app->put('/{id:[0-9]+}',
            '\MartynBiz\Auth\Controller\Admin\UsersController:update')->setName('admin_users_update');
        $app->delete('/{id:[0-9]+}',
            '\MartynBiz\Auth\Controller\Admin\UsersController:delete')->setName('admin_users_delete');

    })->add( new \MartynBiz\Auth\Middleware\RoleAccess($container, [ \MartynBiz\Auth\Model\User::ROLE_ADMIN ]) );

})->add( new \MartynBiz\Auth\Middleware\Auth( $container['auth'] ) );
