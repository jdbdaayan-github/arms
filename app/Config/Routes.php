<?php

use App\Controllers\AuthController;
use App\Controllers\PermissionController;
use App\Controllers\RoleController;
use App\Controllers\SystemController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', function(){
    return redirect()->to('auth/login');
});

//auth
$routes->group('auth', function($routes){
    $routes->get('login', [AuthController::class, 'login']);
    $routes->post('authenticate', [AuthController::class, 'authenticate']);
    $routes->get('register', [AuthController::class, 'register']);
    $routes->get('logout', [AuthController::class, 'logout']);
    $routes->get('forgot', [AuthController::class, 'forgot']);
    $routes->get('reset', [AuthController::class, 'reset']);
    $routes->get('terms', [AuthController::class, 'terms']);
});

$routes->group('',['filter' => 'auth'], function($routes){

    $routes->get('dashboard', 'Home::index');

    #Records
    $routes->group('records', function($routes)
    {
        $routes->get('', 'RecordController::index');
        $routes->get('create', 'RecordController::create');
        $routes->get('view', 'Home::view');
        $routes->get('getIndexes/(:num)', 'RecordController::getIndexes/$1');
    });
    
    #Users
    $routes->group('users', function($routes)
    {
        $routes->get('', 'UserController::index');
        $routes->get('create', 'UserController::create');
        $routes->get('profile/(:num)', 'UserController::profile/$1');
    });

    #Roles
    $routes->group('roles', function($routes)
    {
        $routes->get('', 'RoleController::index');
        $routes->get('create', 'RoleController::create');
        $routes->get('ajaxRolesData', [RoleController::class, 'ajaxRolesData']);
        $routes->get('permissions/(:num)', [RoleController::class, 'rolePermissions']);
        $routes->post('savePermissions/(:num)', [RoleController::class, 'savePermissions']);
        //$routes->get('ajaxRolePermissionData/(:num)', [RoleController::class,'ajaxRolePermissionData']);
    });

    #Permissions
    $routes->group('permissions', function($routes)
    {
        $routes->get('', 'PermissionController::index');
        $routes->get('create', 'PermissionController::create');
        $routes->get('ajaxPermissionsData', [PermissionController::class, 'ajaxPermissionsData']);
        $routes->post('store', [PermissionController::class, 'store']);
        $routes->get('edit/(:num)', [PermissionController::class, 'edit']);
       
    });

    $routes->get('logs/access', [SystemController::class, 'access']);
    $routes->get('logs/audit', [SystemController::class, 'audit']);
    $routes->get('settings/profile', [SystemController::class, 'profile']);
    $routes->get('settings/preferences', [SystemController::class, 'preferences']);
});

