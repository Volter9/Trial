<?php

use Trial\Routing\Routes,
	Trial\Routing\RoutesFactory;

/**
 * Define your routes here
 * 
 * @package Trial
 */

$routes = new Routes;
$factory = new RoutesFactory;

$routes->add('home', 
	$factory->controller('/', '\App\Controllers\Index')
);

$routes->add('pages', 
	$factory->controller('/pages/', '\App\Controllers\Pages')
);
$routes->add('page', 
	$factory->controller('/pages/@page', '\App\Controllers\Pages::page')
);

$routes->add('categories', 
	$factory->controller('/categories/', '\App\Controllers\Categories')
);
$routes->add('category', 
	$factory->controller('/categories/@category', '\App\Controllers\Categories::category')
);

$routes->add('users', 
	$factory->controller('/users/', '\App\Controllers\Users')
);
$routes->add('user', 
	$factory->controller('/users/@user', '\App\Controllers\Users::user')
);

$routes->add('auth.login',
	$factory->controller('GET /auth/login', '\App\Controllers\Auth::logIn')
);
$routes->add('auth.loginPost',
	$factory->controller('POST /auth/login', '\App\Controllers\Auth::logInPost')
);

return $routes;