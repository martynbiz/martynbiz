<?php
// Routes

$container = $app->getContainer();

$app->get('/', '\MartynBiz\Blog\Controller\IndexController:index')->setName('home');

// TODO move these to another module
$app->get('/portfolio', '\MartynBiz\Blog\Controller\ArticlesController:portfolio')->setName('portfolio');
$app->get('/contact', '\MartynBiz\Blog\Controller\ArticlesController:contact')->setName('contact');

$app->group('/articles', function () use ($app) {
    $app->get('', '\MartynBiz\Blog\Controller\ArticlesController:index')->setName('articles');
    $app->get('/{id:[0-9]+}', '\MartynBiz\Blog\Controller\ArticlesController:show')->setName('articles_show');
    $app->get('/{id:[0-9]+}/{slug}', '\MartynBiz\Blog\Controller\ArticlesController:show')->setName('articles_show_wslug');
});

$app->group('/photos', function () use ($app) {
    $app->get('/{path:[0-9]+\/[0-9]+\/[0-9]+\/.+}.jpg', '\MartynBiz\Blog\Controller\PhotosController:cached')->setName('photos_cached');
});

$app->group('/admin', function () use ($app, $container) {

    $app->group('/articles', function () use ($app) {

        $app->get('', '\MartynBiz\Blog\Controller\Admin\ArticlesController:index')->setName('admin_articles');
        $app->get('/{id:[0-9]+}', '\MartynBiz\Blog\Controller\Admin\ArticlesController:show')->setName('admin_articles_show');
        $app->get('/{id:[0-9]+}/edit', '\MartynBiz\Blog\Controller\Admin\ArticlesController:edit')->setName('admin_articles_edit');
        $app->post('', '\MartynBiz\Blog\Controller\Admin\ArticlesController:post')->setName('admin_articles_post');
        $app->delete('/{id:[0-9]+}', '\MartynBiz\Blog\Controller\Admin\ArticlesController:delete')->setName('admin_articles_delete');
        $app->put('/{id:[0-9]+}', '\MartynBiz\Blog\Controller\Admin\ArticlesController:update')->setName('admin_articles_update');

        $app->post('/upload', '\MartynBiz\Blog\Controller\Admin\FilesController:upload')->setName('admin_articles_upload');
    });

    // admin/tags/* routes
    $app->group('/tags', function () use ($app) {
        $app->get('', '\MartynBiz\Blog\Controller\Admin\TagsController:index')->setName('admin_tags');
        // $app->get('/{id:[0-9]+}', '\MartynBiz\Blog\Controller\Admin\TagsController:show')->setName('admin_tags_show');
        $app->get('/create', '\MartynBiz\Blog\Controller\Admin\TagsController:create')->setName('admin_tags_create');
        $app->get('/{id:[0-9]+}/edit', '\MartynBiz\Blog\Controller\Admin\TagsController:edit')->setName('admin_tags_edit');
        $app->post('', '\MartynBiz\Blog\Controller\Admin\TagsController:post')->setName('admin_tags_post');
        $app->put('/{id:[0-9]+}', '\MartynBiz\Blog\Controller\Admin\TagsController:update')->setName('admin_tags_update');
        $app->delete('/{id:[0-9]+}', '\MartynBiz\Blog\Controller\Admin\TagsController:delete')->setName('admin_tags_delete');

    })->add( new MartynBiz\Auth\Middleware\RoleAccess($container, [ MartynBiz\Auth\Model\User::ROLE_ADMIN ]) );

    // admin/articles routes
    $app->group('/data', function () use ($app) {

        $app->map(['GET', 'POST'], '/import', '\MartynBiz\Blog\Controller\Admin\DataController:import')->setName('admin_data_import');

    })->add( new MartynBiz\Auth\Middleware\RoleAccess($container, [ MartynBiz\Auth\Model\User::ROLE_ADMIN ]) );

})->add( new MartynBiz\Auth\Middleware\Auth( $container['auth'] ) ); // user must be authenticated
