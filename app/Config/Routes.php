<?php

use App\Controllers\Home;
use App\Controllers\AuthController;
use App\Controllers\RoleController;
use App\Controllers\UserController;
use App\Controllers\OfficeController;
use App\Controllers\RecordController;
use App\Controllers\SessionController;
use App\Controllers\CategoryController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\PermissionController;
use App\Controllers\DirectorateController;
use App\Controllers\ClassificationController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('login/authenticate', [AuthController::class,'authenticate']);
$routes->get('logout', [AuthController::class,'logout']);
$routes->get('check-session', [SessionController::class,'check']);

// Dashboard
$routes->group('dashboard',['filter'=>'auth'], function (RouteCollection $routes) {
    $routes->get('', [RecordController::class,'index']);
});

// User routes
$routes->group('users',[''=> 'auth'], function (RouteCollection $routes) {
    $routes->get('', [UserController::class,'index']);
    $routes->get('getUsersData', [UserController::class,'getUsersData']);
    $routes->get('roles/(:num)',[UserController::class, 'roles'] );
    $routes->get('getRolesData/(:num)',[UserController::class, 'getRolesData']);
    $routes->post('addRole/(:num)', [UserController::class, 'addRoleToUser']);
    $routes->get('deleteRole/(:num)/(:num)', [UserController::class, 'deleteRole']);
});

// Roles routes
$routes->group('roles',['filter'=> 'auth'], function (  RouteCollection $routes) {
    $routes->get('', [RoleController::class,'index']);
    $routes->get('getRolesData', [RoleController::class, 'getRolesData']);
    $routes->get('permissions/(:num)', [RoleController::class,'permissions']);
    $routes->get('getRolePermissions/(:num)', [RoleController::class,'getRolePermissions']);
    $routes->post('savePermission/(:num)', [RoleController::class,'savePermissions']);
    $routes->get('removePermission/(:num)/(:num)', [RoleController::class,'deletePermissions']);
});

// Permission routes
$routes->group('permissions',['filter'=> 'auth'], function (RouteCollection $routes) {
    $routes->get('', [PermissionController::class,'index']);
    $routes->get('getPermissionsData', [PermissionController::class,'getPermissionsData']);
});

// Directorate routes
$routes->group('directorates',['filter'=> 'auth'], function (RouteCollection $routes) {
    $routes->get('', [DirectorateController::class,'index']);
    $routes->get('getDirectoratesData', [DirectorateController::class,'getDirectoratesData']);
});

// Offices routes
$routes->group('offices',['filter'=> 'auth'], function ( RouteCollection $routes) {
    $routes->get('', [OfficeController::class,'index']);
    $routes->get('getOfficesData', [OfficeController::class,'getOfficesData']);
});

// Libraries routes
$routes->group('libraries', ['filter' => 'auth'], function (RouteCollection $routes) { 
    
    // Libraries/Records
    $routes->group('records', function (RouteCollection $routes) { 

        // Libraries/Records/classifications
        $routes->group('classifications', function (RouteCollection $routes) { 
            $routes->get('', [ClassificationController::class, 'index']);
            $routes->get('getClassificationsData', [ClassificationController::class,'getClassificationsData']);
        });

        // Libraries/Records/Categories
        $routes->group('categories', function (RouteCollection $routes) { 
            $routes->get('', [CategoryController::class, 'index']);
            $routes->get('getCategoriesData', [CategoryController::class,'getCategoriesData']);
        });
    
    });
});