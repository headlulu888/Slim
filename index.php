<?php

require_once "vendor/autoload.php";

\Slim\Slim::registerAutoloader();
\Slim\Route::setDefaultConditions(
    [
        'id' => '[1-9]+',
        'name' => '[a-zA-Z]{3,}'
    ]
);

$app = new Slim\Slim([
    'templates.path' => __DIR__ . '/templates',
//    'view' => new Customview()
]);

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('path/to/templates', [
        'cache' => 'path/to/cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

$app->get('/article(/:name(/:id))', function ($name = 'ray', $id = 1) use($app) {
    $list = ['alex', 'bob', 'frank'];

    $app->render('index2.tpl.php', [
        'title' => 'Шаблон',
        'list' => $list,
        'link' => $app->urlFor('page', [
            'id' => 56
        ])
    ]);
})->name('page');

//$getAdmin = function () {
//    echo "Hello admin";
//};
//
//$authAdmin = function (\Slim\Route $route) use($app) {
//    echo $route->getName();
//};

// admin/message/view/:id
// admin/message/add

// admin/category/view/:id
// admin/category/add

// $app->get('/admin', $authAdmin, $getAdmin)->name('admin');

//$app->group('/admin', function () use($app){
//    $app->group('/message', function () use($app){
//        $app->get('/view/:id', function ($id) {
//            echo 'hello view'. $id;
//        });
//
//        $app->post('/add', function () use($app){
//            print_r($_POST);
//        });
//    });
//
//    $app->group('/category', function () use($app) {
//        $app->get('/view/:id', function ($id) use($app) {
//            echo 'hello category '. $id;
//        });
//
//        $app->post('/add', function () {
//            print_r($_POST);
//        });
//    });
//});

$app->get('/helpers/:name', function ($name) use($app) {
    echo 'hello ' . $name;

    // $app->halt(500, 'server error');
    // $app->pass();
    // $app->redirect($app->urlFor('page'), 301);


    $response = $app->response;
    $response->setStatus(404);
    $response->write('page not f');
    $response->headers->set('Content-type', 'text/plain');

    $array = $response->finalize();
    print_r($array);

    $app->stop();

    echo ' world';
});

$app->get('/helpers/sergey', function () use($app) {
    echo 'sergey';
});

$app->run();