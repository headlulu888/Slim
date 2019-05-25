<?php

require_once "vendor/autoload.php";

\Slim\Slim::registerAutoloader();
\Slim\Route::setDefaultConditions(
    [
        'id' => '[1-9]+',
        'name' => '[a-zA-Z]{3,}'
    ]
);

// print_r(\Slim\Route::getDefaultConditions());

$app = new Slim\Slim([
    'host' => 'localhost',
    'user' => 'user',
    'pass' => 'pass',
    'db' => 'dbname',

    'mode' => 'development',
    'debug' => TRUE,
    'templates.path' => 'templates',

    'cookies.encrypt' => TRUE,
    'cookies.lifetime' => '20 minutes',
    'cookies.path' => '/',
    'cookies.domain' => 'slim', // current domain
    'cookies.secure' => FALSE,
    'cookies.httponly' => TRUE,
    'cookies.secret_key' => 'key',
    'cookies.cipher' => 'cipher',
    'cookies.cipher_mode' => 'mode'
]);

//$app->configureMode('development', function () use($app) {
//    $app->config([
//        'debug' => TRUE,
//        'templates.path' => "templates"
//    ]);
//});
//
//$app->configureMode('test', function () use($app) {
//    $app->config([
//        'debug' => FALSE,
//        'templates.path' => "templ"
//    ]);
//});

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

$getAdmin = function () {
    echo "Hello admin";
};

//$authAdmin = function ($role = 'moderator') use($app) {
//    return function () use($role, $app) {
//        echo $role;exit();
//        if ( 1 !== 10) {
//            $app->redirect($app->urlFor('page'));
//        }
//    };
//};

$authAdmin = function (\Slim\Route $route) use($app) {
    echo $route->getName();
};

// $app->get('/admin', $authAdmin('admin'), $getAdmin);
$app->get('/admin', $authAdmin, $getAdmin)->name('admin');

//$app->post('/add', function () {
//    print_r($_POST);
//    echo 'post';
//});
//
//$app->put('/update', function () {
//    print_r($_POST);
//    echo 'put';
//});
//
//$app->map('/create', function () {
//    echo 'stream';
//})->via("GET", "POST")->name('create');

$app->run();