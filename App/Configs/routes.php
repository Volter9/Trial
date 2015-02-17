<?php

use Trial\Routing\Routes,
	Trial\Routing\Route;

/**
 * Routes:
 * - Index
 * - Pages
 * - Categories
 * - Users
 * 
 * @package Trial
 * @var \Trial\Routing\Router $routes
 */

$router->add('GET /', '\App\Controllers\Index', 'home');

$router->add('GET /pages/@page', '\App\Controllers\Pages::page', 'page');
$router->add('GET /pages/', '\App\Controllers\Pages', 'pages');

$router->add('GET /categories/@category', '\App\Controllers\Categories::category', 'category');
$router->add('GET /categories/', '\App\Controllers\Categories::category', 'categories');

$router->add('GET /users/', '\App\Controllers\Users', 'users');
$router->add('GET /users/@user', '\App\Controllers\Users::user', 'user');

$router->setErrorRoute('GET /', '\App\Controllers\Error');