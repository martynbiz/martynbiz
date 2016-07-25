# Slim Modules Skeleton #

## Installation ##

```
$ composer create-project martynbiz/slim-module-skeleton myproject
```

## Install modules ##

```
$ composer require martynbiz/slim-module-auth
$ composer require martynbiz/slim-module-blog
```

Slim-module
separate folders (e.g. /templates, /src)
* more consistent with slim skeleton
* easier to find templates
* only one template folder required (less searching)




TODO

auth

auth app middleware - this middleware attaches the currentUser to the renderer's data,
other modules don't extend from auth's base controller

Create skeleton app - does it run stand alone?
Install auth module - does it run with only core
Install blog module - does it run with only core and auth

require core in auth module
require core, auth in blog


slim-module-staticpages

$staticRoutePrefix = '/pages';

$app->get($staticRoutePrefix . '/portfolio', function($request, $response, $args) {
    $request->setUrl( $c->get('router')->pathFor('static_page', ['file' => 'portfolio']) );
    return $route->run($request, $response);
});

$aliasBuilder('/portfolio', 'static_page', ['file' => 'portfolio']);


Cli

"post-install-cmd": [
    "php cli.phar modules:install"
]

php cli.phar modules:install martynbiz-blog (copy files from /vendor)
php cli.phar modules:remove martynbiz-blog


qa module
slim-module-staticpages (alias? e.g. /portfolio -> /pages/portfolio)
slim-module-contactform (ContactController)


Why is this appearing when running the app? Try removing phpunit and trace it
Fatal error: Class 'PHPUnit_Framework_TestCase' not found in /var/www/martynbiz/vendor/martynbiz/php-mongo/tests/MongoIteratorTest.php on line 26




* cache: homepage, tags, photos
* photo manage page (delete photos), tag photos for carousel (featured)
* tags: admin: delete, paginate, create, portal: /tags, tag page, public/private (private for e.g. featured)
* cache busting (foil?), remove coffeescript,
* home - contact form, portfolio
* docs: installation of modules (module/Name/README): add to config, add to composer.json, add to phpunit.xml
* delete confirmation on articles: "are you sure...?"
* finishing touches: tidy up registration form, login form;
* sort
* only admin can edit tags

self hosted
* hosting my website from powburn (lamp, ssl, dns, mail?)
* sync with live db

experiment
* only pass in dependencies rather than container
* inline translation editing (<span data-translation="hello_world">Hello world</span>)
* ajax load with template inheritance (partials/articles_table)
* composer custom installer
* elastic search - configurable (mongo, elastic search, )
* ckeditor plugin: select from uploaded media, dropzone

v2
* auth : remember me
* simple search
* admin: homepage - side menu?
* testing: library tests, module tests, test 40x when not logged in

* convert panels like homebox
* comments:
* translations: japanese site
* article preview
* Auth_Facebook module facebook login
