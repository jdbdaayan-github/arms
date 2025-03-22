<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Home::index', ['as', 'dashboard']);

$routes->get('/records/create', 'Home::addrecord', ['as', 'addrecord']);
