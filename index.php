<?php
/**
 * Created by PhpStorm.
 * User: ray-pc
 * Date: 24/05/2019
 * Time: 21:22
 */

require_once "vendor/autoload.php";

\Slim\Slim::registerAutoloader();

$app = new Slim\Slim();

$app->get('/article', function () {
    echo 'World';
});

$app->run();