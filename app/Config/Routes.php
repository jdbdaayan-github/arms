<?php

use App\Controllers\AuthController;
use App\Controllers\SystemController;
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

    #Records
    $routes->group('records', function($routes)
    {
        $routes->get('', 'Home::records');
        $routes->get('create', 'Home::create');
    });
    
    #Users
    $routes->group('users', function($routes)
    {
        $routes->get('', 'UserController::index');
        $routes->get('create', 'UserController::create');
    });

    #Roles
    $routes->group('roles', function($routes)
    {
        $routes->get('', 'RoleController::index');
        $routes->get('create', 'RoleController::create');
    });

    #Permissions
    $routes->group('permissions', function($routes)
    {
        $routes->get('', 'PermissionController::index');
        $routes->get('create', 'PermissionController::create');
    });

    $routes->get('logs/access', [SystemController::class, 'access']);
    $routes->get('logs/audit', [SystemController::class, 'audit']);
});

