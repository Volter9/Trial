<?php

use Trial\Routing\Routes,
	Trial\Routing\Route;

/**
 * Define your routes here
 * 
 * @package Trial
 */

$routes = new Routes;

$routes->add('home', 
	Route::fromUrl('/', '\App\Controllers\Index')
);

$routes->add('pages', 
	Route::fromUrl('/pages/', '\App\Controllers\Pages')
);
$routes->add('page', 
	Route::fromUrl('/pages/@page', '\App\Controllers\Pages::page')
);

$routes->add('categories', 
	Route::fromUrl('/categories/', '\App\Controllers\Categories')
);
$routes->add('category', 
	Route::fromUrl('/categories/@category', '\App\Controllers\Categories::category')
);

$routes->add('users', 
	Route::fromUrl('/users/', '\App\Controllers\Users')
);
$routes->add('user', 
	Route::fromUrl('/users/@user', '\App\Controllers\Users::user')
);

$routes->add('auth.login',
	Route::fromUrl('GET /auth/login', '\App\Controllers\Auth::logIn')
);
$routes->add('auth.loginPost',
	Route::fromUrl('POST /auth/login', '\App\Controllers\Auth::logInPost')
);

return $routes;