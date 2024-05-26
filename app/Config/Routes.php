<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'MainController::index');
$routes->match(['get', 'post'], 'cart', 'MainController::cart');
$routes->match(['get', 'post'], 'profile', 'MainController::profile');
$routes->match(['get', 'post'], 'order_details/(:num)', 'MainController::order_details/$1');
$routes->get('docs/(:segment)', 'MainController::documents/$1');

$routes->match(['post'], 'login', 'MainController::login');
$routes->match(['get'], 'logout', 'MainController::logout');
$routes->match(['post'], 'otp_verification', 'MainController::otp_verification');
$routes->match(['post'], 'resend_otp', 'MainController::resend_otp');
$routes->match(['post'], 'add_fullname', 'MainController::add_fullname');


$routes->match(['get'], 'order_success', 'MainController::order_placed');
$routes->match(['post'], 'checkout', 'MainController::checkout');
