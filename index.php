<?php

use App\Controllers\ArticlesController;
use App\Controllers\AdminArticlesController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\PersonalAreaController;
use App\Controllers\SubscribeController;
use App\Controllers\CommentController;
use App\Controllers\StaticPagesController;
use App\Controllers\AdminStaticPagesController;
use App\Controllers\AdminUserRoleController;
use App\Controllers\AdminCommentsController;
use App\Controllers\AdminSubscribesController;
use App\Controllers\AdminSettingsController;
use App\Application;
use App\Router;

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new Router();

$router->get('/', ArticlesController::class . '@index');
$router->get('/articles/*', ArticlesController::class . '@show');

$router->get('/admin/articles', AdminArticlesController::class . '@index');
$router->get('/admin/articles/create', AdminArticlesController::class . '@create');
$router->get('/admin/articles/*', AdminArticlesController::class . '@show');
$router->get('/admin/articles/*/edit', AdminArticlesController::class . '@edit');
$router->post('/admin/articles/create', AdminArticlesController::class . '@store');
$router->post('/admin/articles/*/edit', AdminArticlesController::class . '@update');
$router->post('/admin/articles/*/delete', AdminArticlesController::class . '@destroy');

$router->get('/login/form', LoginController::class . '@showLoginForm');
$router->post('/login/check', LoginController::class . '@checkUser');

$router->get('/register/form', RegisterController::class . '@showRegisterForm');
$router->post('/register/create', RegisterController::class . '@create');
$router->get('/logout', RegisterController::class . '@logout');

$router->get('/user/id/*', PersonalAreaController::class . '@show');
$router->post('/user/id/*', PersonalAreaController::class . '@update');

$router->post('/subscribe', SubscribeController::class . '@subscribe');
$router->post('/subscribe/destroy/', SubscribeController::class . '@destroy');

$router->post('/articles/*', CommentController::class . '@addComment');

$router->get('/page/*', StaticPagesController::class . '@show');

$router->get('/pages/', AdminStaticPagesController::class . '@index');
$router->get('/static_page/create', AdminStaticPagesController::class . '@create');
$router->post('/static_page/create', AdminStaticPagesController::class . '@store');
$router->get('/static_page/*/edit', AdminStaticPagesController::class . '@edit');
$router->post('/static_page/*/edit', AdminStaticPagesController::class . '@update');
$router->post('/page/*/delete', AdminStaticPagesController::class . '@destroy');

$router->get('/admin/user/role', AdminUserRoleController::class . '@edit');
$router->post('/user/role/*/edit', AdminUserRoleController::class . '@update');

$router->get('/admin/comments', AdminCommentsController::class . '@edit');
$router->post('/admin/comment/*/edit', AdminCommentsController::class . '@update');
$router->post('/admin/comment/*/delete', AdminCommentsController::class . '@destroy');

$router->get('/admin/subscribes', AdminSubscribesController::class . '@edit');
$router->post('/admin/subscribes/*/delete', AdminSubscribesController::class . '@destroy');
$router->post('/admin/subscribes/create', AdminSubscribesController::class . '@store');

$router->get('/admin/settings', AdminSettingsController::class . '@edit');
$router->post('/admin/settings/edit', AdminSettingsController::class . '@update');

$application = new Application($router);

$application->run();
