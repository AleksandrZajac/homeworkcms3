<?php

use App\Controllers\HomeController;
use App\View;
use App\Controllers\BooksController;
use App\Controllers\ArticlesController;

use App\Application;
use App\Router;

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new Router();

// $router->get('/',      HomeController::class . '@index');
$router->get('/about', HomeController::class . '@about');
$router->get('/test1',     function () {
    return 'test1';
});
$router->get('/test2', function () {
    return new View('index', ['title' => 'Index Page']);
});
$router->get('/test3', function () {
    return new View('personal.messages.show', ['title' => 'Personal Messages Page']);
});
$router->get('/book/reader', BooksController::class . '@reader');

$router->get('/', ArticlesController::class . '@index');
$router->get('/articles/create', ArticlesController::class . '@create');
$router->get('/articles/*', ArticlesController::class . '@show');
$router->post('/', ArticlesController::class . '@store');

// $router->get('/articles/*', function ($param1) {
//     return "Test page with param1 = $param1";
// });

$router->get('/test/*/test2/*', function ($param1, $param2) {
    return "Test page with param1 = $param1 param2 = $param2";
});

$application = new Application($router);

$application->run();
