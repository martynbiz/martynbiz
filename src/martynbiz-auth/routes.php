<?php
// Routes

use MartynBiz\Auth\Middleware;
use MartynBiz\Auth\Model\User;

$container = $app->getContainer();

$app->group('/auth', function () {

    $this->post('',
        '\MartynBiz\Auth\Controller\SessionController:post')->setName('auth_session_post');
    $this->delete('',
        '\MartynBiz\Auth\Controller\SessionController:delete')->setName('auth_session_delete');
    $this->get('/login',
        '\MartynBiz\Auth\Controller\SessionController:index')->setName('auth_session_login');
    $this->get('/logout',
        '\MartynBiz\Auth\Controller\SessionController:index')->setName('auth_session_logout');

    $this->get('/register',
        '\MartynBiz\Auth\Controller\UsersController:create')->setName('auth_users_create');
    $this->post('/register',
        '\MartynBiz\Auth\Controller\UsersController:post')->setName('auth_users_post');
    $this->get('/resetpassword',
        '\MartynBiz\Auth\Controller\UsersController:resetpassword')->setName('auth_users_reset_password');
    $this->post('/resetpassword',
        '\MartynBiz\Auth\Controller\UsersController:resetpassword')->setName('auth_users_reset_password_post');
});

// admin routes -- invokes auth middleware
$app->group('/admin', function () {

    // admin/users routes
    $this->group('/users', function () {

        $this->get('',
            '\MartynBiz\Auth\Controller\Admin\UsersController:index')->setName('admin_users');
        $this->get('/{id:[0-9]+}',
            '\MartynBiz\Auth\Controller\Admin\UsersController:show')->setName('admin_users_show');
        $this->get('/create',
            '\MartynBiz\Auth\Controller\Admin\UsersController:create')->setName('admin_users_create');
        $this->get('/{id:[0-9]+}/edit',
            '\MartynBiz\Auth\Controller\Admin\UsersController:edit')->setName('admin_users_edit');

        $this->put('/{id:[0-9]+}',
            '\MartynBiz\Auth\Controller\Admin\UsersController:update')->setName('admin_users_update');
        $this->delete('/{id:[0-9]+}',
            '\MartynBiz\Auth\Controller\Admin\UsersController:delete')->setName('admin_users_delete');

    })->add( new Middleware\RoleAccess($this->getContainer(), [ User::ROLE_ADMIN ]) );

})->add( new Middleware\Auth( $container['auth'] ) );
