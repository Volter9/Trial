<?php

return [
	'init' => function () {
		ob_start();
		
		ini_set('display_errors', 1);
		error_reporting(-1);

		date_default_timezone_set('Europe/Moscow');
	},
	
	'routes' => function ($router) {
		$router->add('GET /@abc', '\App\Controllers\Index', 'home');
		$router->add('GET /json/format', '\App\Controllers\Index::json', 'json');
		$router->add('GET /@id/@pid/@uid', '\App\Controllers\Index::cool', 'cool');
		
		$router->setErrorRoute('GET /', '\App\Controllers\Error');
	}
];