<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\RoleController;
use App\Controllers\UserController;
use App\Controllers\RecordController;
use App\Controllers\SystemController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\PermissionController;
use App\Controllers\RecordIndexController;
use App\Controllers\RecordSeriesController;
use App\Controllers\RecordClassificationController;
use App\Controllers\RecordRequestController;
use App\Controllers\ReportController;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', function () {
    session()->destroy();
    return redirect()->to('auth/login');
});

//auth
$routes->group('auth', function ($routes) {
    $routes->get('login', [AuthController::class, 'login']);
    $routes->post('authenticate', [AuthController::class, 'authenticate']);
    $routes->get('register', [AuthController::class, 'register']);
    $routes->get('logout', [AuthController::class, 'logout']);
    $routes->get('forgot', [AuthController::class, 'forgot']);
    $routes->post('reset', [AuthController::class, 'reset']);
    $routes->get('terms', [AuthController::class, 'terms']);
});

$routes->group('', ['filter' => 'auth'], function ($routes) {

    #Dashboards
    $routes->group('dashboard', function ($routes) {
        $routes->get('superadmin', [DashboardController::class, 'superadminDashboard']);
        $routes->get('administrator', [DashboardController::class, 'adminDashboard']);
        $routes->get('archivist', [DashboardController::class, 'archivistDashboard']);
        $routes->get('records-officer', [DashboardController::class, 'recordsOfficerDashboard']);
        $routes->get('contributor', [DashboardController::class, 'contributorDashboard']);
    });

    #Records
    $routes->group('records', function ($routes) {
        $routes->get('', 'RecordController::index');
        $routes->get('create', 'RecordController::create');
        $routes->post('store', 'RecordController::store');
        $routes->get('edit/(:num)', [RecordController::class, 'edit']);
        $routes->get('show/(:num)', [RecordController::class, 'show']);
        $routes->get('preview/(:any)', [RecordController::class, 'preview']);
        $routes->get('edit_preview/(:any)', [RecordController::class, 'edit_preview']);
        $routes->post('update/(:num)', [RecordController::class, 'update']);
        $routes->get('getIndexes/(:num)', 'RecordController::getIndexes/$1');
        $routes->get('workflow/(:num)', [RecordController::class, 'workflow']);
        $routes->get('approval', [RecordController::class, 'approval']);
        $routes->get('approve/(:num)', [RecordController::class, 'approveRecord']);
        $routes->get('archival', [RecordController::class, 'archival']);
        $routes->get('archive/(:num)', [RecordController::class, 'archive']);
        $routes->get('requests', [RecordRequestController::class, 'index']);
        $routes->get('search', [RecordController::class, 'search']);
        $routes->get('request/(:num)', [RecordRequestController::class, 'request']);
        $routes->post('submitRequest/(:num)', [RecordRequestController::class, 'submitRequest']);
        $routes->post('bookmark/(:num)', [RecordController::class, 'bookmark']);
        $routes->get('test', function () {
            return view('pages/records/test');
        });
    });

    #Users
    $routes->group('users', function ($routes) {
        $routes->get('', 'UserController::index');
        $routes->get('ajaxUsersData', [UserController::class, 'ajaxUsersData']);
        $routes->post('toggleVerify/(:num)', [UserController::class, 'toggleVerify']);
        $routes->get('create', 'UserController::create');
        $routes->post('store', [UserController::class, 'store']);
        $routes->get('profile/(:num)', 'UserController::profile/$1');
        $routes->post('profile/update/(:num)', [UserController::class, 'profileUpdate']);
        $routes->post('profile/change-password/(:num)', [UserController::class, 'profilePassUpdate']);
        $routes->post('resetAttempts/(:num)', [UserController::class, 'resetAttempts']);
        $routes->get('permissions/(:num)', [UserController::class, 'user_permissions']);
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
        $routes->post('store', [RecordSeriesController::class, 'store']);
        $routes->get('edit/(:num)', [RecordSeriesController::class, 'edit']);
        $routes->post('update/(:num)', [RecordSeriesController::class, 'update']);
        $routes->get('index/(:num)', [RecordSeriesController::class, 'indexes']);
        $routes->get('indexesData/(:num)', [RecordSeriesController::class, 'indexesData']);
        $routes->post('addIndex/(:num)', [RecordSeriesController::class, 'addIndex']);
        $routes->post('deleteIndex/(:num)', [RecordSeriesController::class, 'removeIndex']);
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
    $routes->get('audit/ajaxLogs', [SystemController::class, 'ajaxLogs']);
    $routes->get('logs/audit/view/(:num)', [SystemController::class, 'audit_view']);
    $routes->get('settings/profile', [SystemController::class, 'profile']);
    $routes->get('settings/preferences', [SystemController::class, 'preferences']);
    $routes->get('system/checkSession', [SystemController::class, 'checkSession']);

    #Reports
    $routes->group('reports', function ($routes) {
        $routes->get('borrowed', [ReportController::class, 'borrowed']);
        $routes->get('returned', [ReportController::class, 'returned']);
        $routes->get('summary', [ReportController::class, 'summary']);
        $routes->get('users', [ReportController::class, 'users']);
    });
});
