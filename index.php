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

//echo $app->config(array(
//    'debug' => TRUE,
//    'templates.path' => "templates"
//));

echo "<pre>";
echo $app->config('templates.path');
echo "</pre>";

$app->get('/article', function () use($app) {

    echo 'World';
});

$app->run();