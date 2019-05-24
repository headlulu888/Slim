<?php

require_once "vendor/autoload.php";

\Slim\Slim::registerAutoloader();

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

$app->configureMode('development', function () use($app) {
    $app->config([
        'debug' => TRUE,
        'templates.path' => "templates"
    ]);
});

$app->configureMode('test', function () use($app) {
    $app->config([
        'debug' => FALSE,
        'templates.path' => "templ"
    ]);
});

$app->get('/article(/:name(/:id))', function ($name = 'ray', $id = 1) use($app) {
    echo 'param = ' . $name . '|' . $id;
});

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