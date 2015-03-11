<?php

/**
 * Routes
 */

return [
	'home' => [
		'path'       => '/', 
		'controller' => '\App\Controllers\Index'
	],
	
	'pages' => [
		'path'       => '/pages/',
		'controller' => '\App\Controllers\Pages'
	],
	
	'page' => [
		'path'       => '/pages/@page/',
		'controller' => '\App\Controllers\Pages::page'
	],
	
	'categories' => [
		'path'       => '/categories/',
		'controller' => '\App\Controllers\Categories'
	],
	
	'category' => [
		'path'       => '/categories/@category/',
		'controller' => '\App\Controllers\Categories::category'
	],
	
	'users' => [
		'path'       => '/users/',
		'controller' => '\App\Controllers\Users'
	],
	
	'user' => [
		'path'       => '/users/@user/',
		'controller' => '\App\Controllers\Users::user'
	],
	
	'auth.login' => [
		'path'       => '/auth/login/',
		'method'     => 'GET',
		'controller' => '\App\Controllers\Auth::logIn'
	],
	
	'auth.login.post' => [
		'path'       => '/auth/login/',
		'method'     => 'POST',
		'controller' => '\App\Controllers\Auth::logInPost'
	]
];