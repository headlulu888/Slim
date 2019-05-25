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

$getAdmin = function () {
    echo "Hello admin";
};

$authAdmin = function (\Slim\Route $route) use($app) {
    echo $route->getName();
};

$app->get('/admin', $authAdmin, $getAdmin)->name('admin');

$app->run();