<?php

use App\Controllers\AuthController;
use App\Controllers\Home;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('login/authenticate', [AuthController::class,'authenticate']);

$routes->group('dashboard',['filter'=>'auth'], function (RouteCollection $routes) {
    $routes->get('', [Home::class,'index']);
});
$routes->group('users',[''=> 'auth'], function (RouteCollection $routes) {
    $routes->get('', [UserController::class,'index']);
    $routes->get('getUsersData', [UserController::class,'getUsersData']);
});
