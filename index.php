<?php

require_once "vendor/autoload.php";

\Slim\Slim::registerAutoloader();
\Slim\Route::setDefaultConditions(
    [
        'id' => '[1-9]+',
        'name' => '[a-zA-Z]{3,}'
    ]
);

$app = new Slim\Slim();

$app->get('/article(/:name(/:id))', function ($name = 'ray', $id = 1) use($app) {
    echo 'param = ' . $name . '|' . $id;
    $link = $app->urlFor('page', [
        'id' => '50',
        'name' => 'Sergey'
    ]);
    echo "<p><a href='" . $link . "'>URL</a></p>";

})->name('page')->conditions([
    'id' => '[a-zA-Z]{3,}'
]);

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