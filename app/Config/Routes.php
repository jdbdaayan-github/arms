<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Home::index');
$routes->get('/records', 'Home::records');
$routes->get('/records/create', 'Home::create');
