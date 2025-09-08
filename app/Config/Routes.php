<?php

use App\Controllers\AuthController;
use App\Controllers\RoleController;
use App\Controllers\UserController;
use App\Controllers\RecordController;
use App\Controllers\SystemController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\PermissionController;
use App\Controllers\RecordIndexController;
use App\Controllers\RecordSeriesController;
use App\Controllers\RecordClassificationController;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', function () {
    return redirect()->to('auth/login');
});

//auth
$routes->group('auth', function ($routes) {
    $routes->get('login', [AuthController::class, 'login']);
    $routes->post('authenticate', [AuthController::class, 'authenticate']);
    $routes->get('register', [AuthController::class, 'register']);
    $routes->get('logout', [AuthController::class, 'logout']);
    $routes->get('forgot', [AuthController::class, 'forgot']);
    $routes->get('reset', [AuthController::class, 'reset']);
    $routes->get('terms', [AuthController::class, 'terms']);
});

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'Home::index');

    #Records
    $routes->group('records', function ($routes) {
        $routes->get('', 'RecordController::index');
        $routes->get('create', 'RecordController::create');
        $routes->post('store', 'RecordController::store');
        $routes->get('show/(:num)', [RecordController::class,'show']);
        $routes->get('getIndexes/(:num)', 'RecordController::getIndexes/$1');
    });

    #Users
    $routes->group('users', function ($routes) {
        $routes->get('', 'UserController::index');
        $routes->get('ajaxUsersData', [UserController::class, 'ajaxUsersData']);
        $routes->post('toggleVerify/(:num)', [UserController::class, 'toggleVerify']);
        $routes->get('create', 'UserController::create');
        $routes->get('profile/(:num)', 'UserController::profile/$1');
    });

    #Roles
    $routes->group('roles', function ($routes) {
        $routes->get('', 'RoleController::index');
        $routes->get('create', 'RoleController::create');
        $routes->post('store', [RoleController::class, 'store']);
        $routes->get('edit/(:num)', [RoleController::class, 'edit']);
        $routes->post('update/(:num)', [RoleController::class, 'update']);
        $routes->get('ajaxRolesData', [RoleController::class, 'ajaxRolesData']);
        $routes->get('permissions/(:num)', [RoleController::class, 'rolePermissions']);
        $routes->post('savePermissions/(:num)', [RoleController::class, 'savePermissions']);
        //$routes->get('ajaxRolePermissionData/(:num)', [RoleController::class,'ajaxRolePermissionData']);
    });

    #Permissions
    $routes->group('permissions', function ($routes) {
        $routes->get('', 'PermissionController::index');
        $routes->get('create', 'PermissionController::create');
        $routes->get('ajaxPermissionsData', [PermissionController::class, 'ajaxPermissionsData']);
        $routes->post('store', [PermissionController::class, 'store']);
        $routes->get('edit/(:num)', [PermissionController::class, 'edit']);
        $routes->post('update/(:num)', [PermissionController::class, 'update']);
    });

    #Classifications
    $routes->group('classifications', function ($routes) {
        $routes->get('', [RecordClassificationController::class, 'index']);
        $routes->get('ajaxClassificationsData', [RecordClassificationController::class, 'ajaxClassificationsData']);
        $routes->get('create', [RecordClassificationController::class, 'create']);
        $routes->post('store', [RecordClassificationController::class, 'store']);
        $routes->get('edit/(:num)', [RecordClassificationController::class, 'edit']);
        $routes->post('update/(:num)', [RecordClassificationController::class, 'update']);
    });

    #Record Series
    $routes->group('series', function ($routes) {
        $routes->get('', [RecordSeriesController::class, 'index']);
        $routes->get('ajaxRecordSeriesData', [RecordSeriesController::class, 'ajaxRecordSeriesData']);
        $routes->get('create', [RecordSeriesController::class, 'create']);

    });

    #Record Indexes
    $routes->group('indexes', function ($routes) {
        $routes->get('', [RecordIndexController::class, 'index']);
        $routes->get('ajaxRecordIndexesData', [RecordIndexController::class, 'ajaxRecordIndexesData']);
        $routes->get('create', [RecordIndexController::class, 'create']);
        $routes->post('store', [RecordIndexController::class, 'store']);
        $routes->get('edit/(:num)', [RecordIndexController::class, 'edit']);
    });

    $routes->get('logs/access', [SystemController::class, 'access']);
    $routes->get('logs/audit', [SystemController::class, 'audit']);
    $routes->get('settings/profile', [SystemController::class, 'profile']);
    $routes->get('settings/preferences', [SystemController::class, 'preferences']);
});
