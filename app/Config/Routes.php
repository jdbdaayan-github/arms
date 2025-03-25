<?php

use App\Controllers\AuthController;
use App\Controllers\DirectorateController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Home::index', ['as', 'dashboard']);
$routes->get('records/create', 'Home::addrecord', ['as', 'addrecord']);
$routes->get('records/advancedsearch', 'Home::advancedsearch', ['as', 'advancedsearch']);

$routes->get('directorates', [DirectorateController::class, 'index']);
$routes->get('directorates/create', [DirectorateController::class, 'create']);
$routes->post('directorates/create', [DirectorateController::class, 'create']);

$routes->get('login', [AuthController::class, 'login']);
$routes->get('register', [AuthController::class, 'register']);
$routes->post('register', [AuthController::class, 'register']);
$routes->get('records', 'Home::home');