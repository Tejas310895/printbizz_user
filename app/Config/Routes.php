<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('cart', 'MainController::cart');
$routes->get('profile', 'MainController::profile');
