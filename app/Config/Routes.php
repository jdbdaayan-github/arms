<?php

use App\Controllers\AuthController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//auth
$routes->group('auth', function($routes){
    $routes->get('login', [AuthController::class, 'login']);
    $routes->post('authenticate', [AuthController::class, 'authenticate']);
    $routes->get('register', [AuthController::class, 'register']);
    $routes->get('forgot', [AuthController::class, 'forgot']);
    $routes->get('reset', [AuthController::class, 'reset']);
    $routes->get('terms', [AuthController::class, 'terms']);
});

$routes->group('',['filter' => 'auth'], function($routes){
    $routes->get('/dashboard', 'Home::index');
    $routes->get('/records', 'Home::records');
    $routes->get('/records/create', 'Home::create');
});

